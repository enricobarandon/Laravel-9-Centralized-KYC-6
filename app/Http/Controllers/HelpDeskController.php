<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\ActivityLog;
use Auth;
use App\Models\GroupStatistics;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InterviewDetailsRequest;
use DB;
use Carbon\Carbon;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\Repositories\Backend\SendSms;

class HelpDeskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $auth = auth()->user();

        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username','group_code','processed_at','processed_by','is_black_listed','site_status')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'verified')
                                ->orderBy('processed_at','desc');

        if($auth->user_type_id == 4){
            $players = $players->where('group_code', $auth->group_code);
        }

        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $code = $request->group_code;

        if($code){
            $players = $players->where('users.group_code', $code);
        }

        $status = $request->player_status;

        if($status != ''){
            $players = $players->where('users.is_active', $status);
        }

        $players = $players->paginate(20);

        $processedBy = User::select('id','username')->get()->pluck('username','id')->toArray();
        // dd($processedBy);
        return view('helpdesk.index', compact('players','keyword','status','code','processedBy'));
    }

    public function forApproval(Request $request)
    {
        $auth = auth()->user();

        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username','group_code','processed_at','processed_by','review_by','is_black_listed','site_status','case_id')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->join('user_details', 'user_details.user_id','users.id')
                                ->where('user_type_id', 5)
                                ->where('status', 'pending')
                                ->orderBy('id','desc');

        if($auth->user_type_id == 4){
            $players = $players->where('group_code', $auth->group_code);
        }

        if($request->id){
            $randomUser = User::select('id')
            ->where('status', 'pending')
            ->where('user_type_id', 5)
            ->get()->pluck('id')->toArray();

            $random_keys = array_rand($randomUser,2);

            $players = $players->where('users.id',$randomUser[$random_keys[0]]);
        }

        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $code = $request->group_code;

        if($code){
            $players = $players->where('users.group_code', $code);
        }

        $status = $request->player_status;

        if($status != ''){
            $players = $players->where('users.is_active', $status);
        }

        $account_status = $request->account_status;

        if($account_status){
            $players = $players->where('users.status', $account_status);
        }

        $players = $players->paginate(20);

        $reviewBy = User::select('id','username')->get()->pluck('username','id')->toArray();

        return view('helpdesk.for-approval', compact('players','keyword','status','account_status','code','reviewBy'));
    }

    public function forReview(Request $request)
    {
        $auth = auth()->user();

        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username','group_code','processed_at','processed_by','review_by','is_black_listed','site_status')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'review')
                                ->orderBy('id','desc');

        if($auth->user_type_id == 4){
            $players = $players->where('group_code', $auth->group_code);
        }

        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $code = $request->group_code;

        if($code){
            $players = $players->where('users.group_code', $code);
        }

        $players = $players->paginate(20);

        return view('helpdesk.for-review', compact('players','keyword','code'));
    }

    public function showPlayerDetails(User $user)
    {
        $auth = auth()->user();

        $userDetails = UserDetails::where('user_id', $user->id)->first();

        if($auth->user_type_id == 4){
            if($user->group_code != $auth->group_code){
                return redirect('/home')->with('error','Access Denied');
            }
        }

        $uuid = $user->uuid;
        $qrcode = new DNS2D();
        $qrCode = $qrcode->getBarcodePNG($uuid, 'QRCODE',15,15);

        $processedBy = User::select('username')->where('id', $user->processed_by)->first();

        $rejectRemarks = config('compliance.decline-remarks');
        $returnRemarks = config('compliance.return-remarks');

        return view('helpdesk.user-details', compact('user','userDetails','processedBy','qrCode','rejectRemarks','returnRemarks'));
    }

    public function changeStatus(User $user, Request $request)
    {
        $auth = auth()->user();

        $operation = '';

        $remarks_logs = '';

        if($request->operation == 'approve'){

            $operation = 'approved';
            $changeStatus = User::where('id', $user->id)->update(['users.status' => 'verified', 'users.processed_by' => $auth->id, 'users.processed_at' => Carbon::now()]);
            //Temporary remove sms function
            // SendSms::send([
            //     'number' =>     $user->contact,
            //     'message' =>    "Good day ". $user->first_name ."! This is Lucky 8. Congratulations! Your application has been approved. Please login to your account to view your QR Code."
            // ]);

        }elseif($request->operation == 'disapprove'){

            $operation = 'disapproved';
            $reasonType = explode(' ', trim($request->disapprove_remarks))[0];

            $siteStatus = '';

            if($auth->user_type_id == 4){
                $siteStatus = 'rejected';
            }else{
                $siteStatus = '';
            }

            if($reasonType == 'Remarks:'){

                $changeStatus = User::where('id', $user->id)->update([
                                            'users.status' => 'disapproved',
                                            'users.site_status' => $siteStatus,
                                            'users.processed_by' => $auth->id,
                                            'users.processed_at' => Carbon::now()
                                        ]);

            }else{

                $changeStatus = User::where('id', $user->id)->update([
                                            'users.is_active' => 0,
                                            'users.status' => 'disapproved',
                                            'users.site_status' => $siteStatus,
                                            'users.processed_by' => $auth->id,
                                            'users.processed_at' => Carbon::now()
                                        ]);

            }

            $remarks = UserDetails::where('user_id', $user->id)->update(['remarks' => $request->disapprove_remarks]);

            $remarks_logs = $request->disapprove_remarks;

        }elseif($request->operation == 'pending'){

            $operation = 'pending';
            $changeStatus = User::where('id', $user->id)->update([
                                                            'users.status' => 'pending',
                                                            'users.processed_by' => $auth->id,
                                                            'users.processed_at' => Carbon::now()
                                                        ]);

        }elseif($request->operation == 'review'){

            $operation = 'reviewed';
            $changeStatus = User::where('id', $user->id)->update([
                                                'users.review_by' => $auth->id,
                                                'users.status' => 'pending',
                                                'users.site_status' => 'submitted'
                                            ]);

        }elseif($request->operation == 'return'){

            $operation = 'returned';
            $changeStatus = User::where('id', $user->id)->update([
                                                'users.processed_by' => $auth->id,
                                                'users.site_status' => 'returned'
                                            ]);

            $remarks = UserDetails::where('user_id', $user->id)->update(['remarks' => $request->return_remarks]);

            $remarks_logs = $request->return_remarks;

        }else{

            return back()->with('error','Something went wrong');

        }

        if($changeStatus){

            ActivityLog::create([
                'type' => $operation.'-player',
                'user_id' => $auth->id,
                'assets' => json_encode([
                    'action' => $operation.' player account',
                    'username' => $user->username,
                    'remarks' => $remarks_logs
                ])
            ]);

            return back()->with('success','Player application '.$operation);
        }else{
            return back()->with('error','Something went wrong');
        }
    }

    public function saveSnapshot(Request $request){

        $auth = auth()->user();
        // dd($auth->id);

        $saveSnapshot = '';

        $validator = Validator::make($request->all(), [
            'snapshot' => ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048']
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $snapshot = 'SS'.$auth->id.time().'.'.$request->snapshot->extension();
            $saveSnapshot = UserDetails::where('user_id', $request->hdnId)->update(['snapshot' => $snapshot]);
        }

        if($saveSnapshot){

            $request->snapshot->move(public_path('img/snapshot'), $snapshot);

            $playerInfo = User::where('id',$request->hdnId)->first();

            ActivityLog::create([
                'type' => 'update-snapshot',
                'user_id' => $auth->id,
                'assets' => json_encode([
                    'action' => 'Update Snapshot of Player',
                    'name' => $playerInfo->first_name . ' ' . $playerInfo->last_name,
                    'username' => $playerInfo->username
                ])
            ]);

            return back()->with('success','Snapshot successfully saved');
        }else{
            return back()->with('error','Something went wrong');
        }
    }

    public function updateInterviewDetails(InterviewDetailsRequest $request, User $user)
    {
        $auth = auth()->user();

        $interviewDetails = [
            "interview_description" => $request['interview_description'],
            "interview_link" => $request['interview_link'],
            "interview_date_time" => date("Y-m-d H:i:s",strtotime($request['interview_date_time'])),
            "case_id" => $request['case_id'],
        ];

        $update = UserDetails::where('user_id', $user->id)->update($interviewDetails);
        if($update){
            $saveSetInterviewBy = User::where('id', $user->id)->update(['users.review_by' => $auth->id]);
            //Temporary remove sms function
            // SendSms::send([
            //     'number' =>     $user->contact,
            //     'message' =>    "Good day players! This is Lucky 8. Your interview appointment via " . $user->user_details->video_app . " is set on " . date('M d, Y h:i A', strtotime($user->user_details->interview_date_time)) . ". Please login to your account to view the interview link."
            // ]);

            ActivityLog::create([
                'type' => 'update-interview-details',
                'user_id' => $auth->id, // guest middlware
                'assets' => json_encode(array_merge([
                    'action' => 'Update Interview Details',
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'username' => $user->username

                ],$interviewDetails))
            ]);

            return back()->with('success','Interview details successfully updated');
        }else{
            return back()->with('error','Something went wrong');
        }
    }
    public function disapproved(Request $request)
    {
        $auth = auth()->user();

        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username','group_code','processed_by','users.updated_at as updated_at','is_black_listed','site_status')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'disapproved')
                                ->orderBy('id','desc');

        if($auth->user_type_id == 4){
            $players = $players->where('group_code', $auth->group_code);
        }

        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $code = $request->group_code;

        if($code){
            $players = $players->where('users.group_code', $code);
        }

        $players = $players->paginate(20);

        $processedBy = User::select('id','username')->get()->pluck('username','id')->toArray();

        return view('helpdesk.disapproved', compact('players','keyword','code','processedBy'));
    }
}
