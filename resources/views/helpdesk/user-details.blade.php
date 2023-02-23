@extends('layouts.app')

@section('content')
@php
$id_type = [
    1 => "Government Service Insurance System (GSIS) Card",
    2 => "Unified Multi-Purpose Identification (UMID) Card",
    3 => "Land Transportation Office (LTO) Driver's License",
    4 => "Professional Regulatory Commission (PRC) ID",
    5 => "Philippine Identification (PhilID)",
    6 => "Commission on Elections (COMELEC) Voter's ID",
    7 => "Senior Citizen ID",
    8 => "Philippine Postal ID (issued November 2016 onwards)",
    9 => "Latest Passport",
    10 => "National ID/PhilSys ID"
];
@endphp
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($user->status == 'review')
            <a href="/helpdesk/for-review" class="btn btn-normal-primary btn-primary mb-3"><i class="fas fa-backward"></i> Back</a>
            @elseif($user->status == 'verified')
            <a href="/helpdesk" class="btn btn-normal-primary btn-primary mb-3"><i class="fas fa-backward"></i> Back</a>
            @elseif($user->status == 'disapproved')
            <a href="/helpdesk/disapproved" class="btn btn-normal-primary btn-primary mb-3"><i class="fas fa-backward"></i> Back</a>
            @else
            <a href="/helpdesk/for-approval" class="btn btn-normal-primary btn-primary mb-3"><i class="fas fa-backward"></i> Back</a>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i> Player Details</h3>
                    @if(in_array(Auth::user()->user_type_id, [1,3]))
                        @if($user->status == 'pending')
                            <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                            @csrf
                                <input type="hidden" name="operation" value="approve" />
                                <button type="button" class="btn btn-info btn-normal btn-sm float-right submit-approval">
                                    <i class="fas fa-check"></i> Approve Application
                                </button>
                            </form>

                            @if($user->site_status != 'returned')
                                <button type="button" class="btn btn-warning btn-sm float-right mr-3 btn-return" data-toggle="modal" data-target="#modal-return">
                                    <i class="fas fa-undo"></i> Return
                                </button>
                            @endif
                            <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                            @csrf
                                <input type="hidden" name="operation" value="disapprove" />
                                <input type="hidden" name="remarks" id="remarks" value="">
                                <button type="button" class="btn btn-danger btn-sm float-right btn-reject mr-3" data-toggle="modal" data-target="#modal-reject">
                                    <i class="fas fa-times"></i> Decline Application
                                </button>
                            </form>
                        @elseif($user->status == 'review')
                            <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                            @csrf
                                <input type="hidden" name="operation" value="review" />
                                <button type="button" class="btn btn-sm btn-primary btn-normal float-right submit-review mr-3">
                                    <i class="fa fa-check"></i> Submit Application
                                </button>
                            </form>
                        @elseif($user->status == 'verified')
                            <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                            @csrf
                                <input type="hidden" name="operation" value="pending" />
                                <button type="button" class="btn btn-primary btn-normal btn-sm float-right submit-pending mr-3">
                                    <i class="fa fa-undo"></i> Back to Pending
                                </button>
                            </form>
                        @endif
                    @endif

                    @if(Auth::user()->user_type_id == 4)
                        @if($user->status == 'verified')
                        <button type="button" class="btn btn-success btn-normal btn-sm float-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-qrcode"></i> View QR Code</button>
                        @elseif($user->status == 'review')
                        <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                        @csrf
                            <input type="hidden" name="operation" value="review" />
                            <button type="button" class="btn btn-sm btn-primary btn-normal float-right submit-review mr-3">
                                <i class="fa fa-check"></i> Submit Application
                            </button>
                        </form>
                        <!-- <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                        @csrf
                            <input type="hidden" name="operation" value="return" />
                            <input type="hidden" name="remarks" id="remarks" value="">
                            <button type="button" class="btn btn-warning btn-normal btn-sm float-right submit-disapprove mr-3" data-toggle="modal" data-target="#modal-returned">
                                <i class="fas fa-times"></i> Return
                            </button>
                        </form> -->
                        <button type="button" class="btn btn-warning btn-sm float-right mr-3 btn-return" data-toggle="modal" data-target="#modal-return">
                                <i class="fas fa-undo"></i> Return
                            </button>
                        <!-- <form action='{{ url("/helpdesk/approve/$user->id") }}' method="POST">
                        @csrf
                            <input type="hidden" name="operation" value="disapprove" />
                            <input type="hidden" name="remarks" id="remarks" value="">
                            <button type="button" class="btn btn-danger btn-normal btn-sm float-right submit-disapprove mr-3" data-toggle="modal" data-target="#modal-reject">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </form> -->
                        <button type="button" class="btn btn-danger btn-sm float-right mr-3 btn-reject" data-toggle="modal" data-target="#modal-reject">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        @endif
                    @endif

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Auth::user()->user_type_id == 3)
                        @if($user->status == 'pending' and $user->review_by != null and $user->review_by != Auth::user()->id)
                        <div class="alert alert-danger" role="alert">
                            This account is already reviewed.
                        </div>
                        @endif
                    @endif

                    <!-- {{ $userDetails }} -->

                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col col-12">
                            <div class="card mb-3" style="border-radius: .5rem;">
                                <div class="row g-0">
                                    <div class="col-md-4 gradient-custom text-center text-white profile-div">
                                        <img src="/img/icons/avatar.png" alt="Avatar" class="img-fluid my-4 img-avatar" />
                                        <h5>{{ strtoupper($user->first_name . ' ' . $user->middle_name  . ' ' . $user->last_name) }}</h5>
                                        <p>{{ isset($userDetails->valid_id_type) ? $id_type[$userDetails->valid_id_type] : '--' }}</p>
                                        @if(isset($userDetails->id_picture))
                                        <img src="/img/id_picture/{{ $userDetails->id_picture }}" alt="Avatar" class="img-responsive my-2 id-img img-thumbnail" />
                                        @endif

                                        @if(isset($userDetails->selfie_with_id))
                                        <img src="/img/id_picture_selfie/{{ $userDetails->selfie_with_id }}" alt="Avatar" class="img-responsive my-5 id-img img-thumbnail" />
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card-body p-4">

                                            <h6><i class="fa fa-info-circle"></i> PLAYER INFORMATION</h6>

                                            <hr class="mt-0 mb-2">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Username</h6>
                                                    <p class="text-muted">{{ isset($user->username) ? $user->username : '--' }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Status</h6>
                                                    @if($user->site_status == 'returned')
                                                        <p class="text-muted">
                                                            <strong class="returned">
                                                                RETURNED
                                                            </strong>
                                                            @if($user->status == 'disapproved' || $user->site_status == 'returned')
                                                                <h6>Remarks: <i class="text-muted">{{ isset($userDetails->remarks) ? $userDetails->remarks : '--' }}</i></h6>
                                                            @endif
                                                        </p>
                                                    @else
                                                        <p class="text-muted">
                                                            <strong class="{{ $user->status }}">
                                                                {{ isset($user->status) ? strtoupper($user->status) : '--' }}
                                                                @if($user->status == 'review')
                                                                ({{ isset($user->site_status) ? strtoupper($user->site_status) : '' }})
                                                                @endif
                                                            </strong>
                                                            @if($user->status == 'disapproved' || $user->site_status == 'returned')
                                                                <h6>Remarks: <i class="text-muted">{{ isset($userDetails->remarks) ? $userDetails->remarks : '--' }}</i></h6>
                                                            @endif
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($user->status == 'disapproved' || $user->site_status == 'returned')
                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Processed By</h6>
                                                    <p class="text-muted">{{ isset($processedBy->username) ? $processedBy->username : '--' }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Processed at</h6>
                                                    <p class="text-muted">{{ isset($user->processed_at) ? date("M. d, Y",strtotime($user->processed_at)) : '--' }}</p>
                                                </div>
                                            </div>
                                            @endif

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Date of Birth</h6>
                                                    <p class="text-muted">{{ isset($userDetails->date_of_birth) ? date("M. d, Y",strtotime($userDetails->date_of_birth)) : '--' }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Place of Birth</h6>
                                                    <p class="text-muted">{{ isset($userDetails->place_of_birth) ? $userDetails->place_of_birth : '--' }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Present Address</h6>
                                                    <p class="text-muted">
                                                        @php
                                                        $presentAddress = '';
                                                            if(isset($userDetails->present_address)){
                                                                $address = json_decode($userDetails->present_address,true);

                                                                $presentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['province'] . " " . $address['zipcode'];
                                                            }else{
                                                                $presentAddress = '--';
                                                            }
                                                        @endphp
                                                        {{ $presentAddress }}
                                                    </p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Permanent Address</h6>
                                                    <p class="text-muted">
                                                        @php
                                                        $permanentAddress = '';
                                                            if(isset($userDetails->permanent_address)){
                                                                $address = json_decode($userDetails->permanent_address,true);

                                                                $permanentAddress = $address['house_number'] . " " . $address['street'] . " " . $address['barangay'] . " " . $address['city'] . " " . $address['province'] . " " . $address['zipcode'];
                                                            }else{
                                                                $permanentAddress = '--';
                                                            }
                                                        @endphp
                                                        {{ $permanentAddress }}
                                                    </p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Nationality</h6>
                                                    <p class="text-muted">{{ isset($userDetails->nationality) ? $userDetails->nationality : '--' }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Country</h6>
                                                    <p class="text-muted">{{ isset($userDetails->country) ? $userDetails->country : '--' }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Source of Income</h6>
                                                    <p class="text-muted">
                                                        @php
                                                        $source_income = '';
                                                            if(isset($userDetails->source_of_income)){
                                                                $income = json_decode($userDetails->source_of_income,true);
                                                                if(json_last_error() === JSON_ERROR_NONE){
                                                                    $source_income = $income['select_source_of_income'] . ": " . $income['source_of_income'];
                                                                }else{
                                                                    $source_income = $userDetails->source_of_income;
                                                                }
                                                            }else{
                                                                $source_income = '--';
                                                            }
                                                        @endphp
                                                        {{ $source_income }}
                                                    </p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Occupation</h6>
                                                    <p class="text-muted">{{ isset($userDetails->occupation) ? $userDetails->occupation : '--' }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            <div class="row pt-1">
                                                <div class="col-6 mb-1">
                                                    <h6>Contact</h6>
                                                    <p class="text-muted">{{ isset($user->contact) ? $user->contact : '--' }}</p>
                                                </div>
                                                <div class="col-6 mb-1">
                                                    <h6>Facebook</h6>
                                                    <p class="text-muted">{{ isset($userDetails->facebook) ? $userDetails->facebook : '--' }}</p>
                                                </div>
                                            </div>

                                            <hr class="mt-0 mb-0">

                                            @if(in_array(Auth::user()->user_type_id, [1,3]) && $user->status != 'review')
                                            <div class="pt-1">

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="box box-info">
                                                            <div class="box-header with-border">
                                                                <h6 class="box-title text-center">Interview Details</h6>
                                                            </div>

                                                            <form class="form-horizontal" action='{{ url("/helpdesk/updateInterviewDetails/$user->id") }}' method="POST">
                                                                @csrf
                                                                <div class="box-body">

                                                                    <div class="form-group">
                                                                        <label class="col-12 control-label">Prefer Video App</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" value="{{ isset($userDetails->video_app) ? $userDetails->video_app : '--' }}" readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="interview_description" class="col-12 control-label">Interview Description</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" id="interview_description" name="interview_description" placeholder="Description">{{ isset($userDetails->interview_description) ? $userDetails->interview_description : '' }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="case_id" class="col-12 control-label">Case Id</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" id="case_id" name="case_id" placeholder="Case Id" value="{{ isset($userDetails->case_id) ? $userDetails->case_id : '' }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="interview_link" class="col-12 control-label">Interview Link</label>
                                                                        <div class="col-sm-12">
                                                                            <textarea class="form-control" id="interview_link" name="interview_link" placeholder="Interview Link">{{ isset($userDetails->interview_link) ? $userDetails->interview_link : '' }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="interview_date_time" class="col-12 control-label">Date and Time</label>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" id="interview_date_time" name="interview_date_time" placeholder="Date and Time" value="{{ $userDetails->interview_date_time != '' ? date('M d, Y h:i a',strtotime($userDetails->interview_date_time)) : '' }}">
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="box-footer text-center">
                                                                    <button type="submit" class="btn btn-primary">Update Interview Details</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <form action='{{ url("/helpdesk/snapshot/$user->id") }}' method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="hdnId" value="{{ $user->id }}">
                                                            <div class="mb-1 text-center">
                                                                <div style="margin: auto;">
                                                                    <h6>Snapshot</h6>
                                                                    <input type="file" class="form-control file-css" name="snapshot" placeholder="Snapshot" accept="capture" id="file-input" required>
                                                                    @error('snapshot')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    @if(isset($userDetails->snapshot))
                                                                    <img src="/img/snapshot/{{ $userDetails->snapshot }}" id="image-previewer" alt="Avatar" class="img-responsive my-2 snapshot-img img-thumbnail" />
                                                                    @else
                                                                    <img src="/img/not-available.gif" alt="No Picture Available" id="image-previewer" class="img-responsive my-2 snapshot-img img-thumbnail" />
                                                                    @endif

                                                                    <input type="submit" class="btn btn-primary" value="Update Snapshot">
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>

                                                </div>

                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.qrcode-modal')
@include('helpdesk.includes.modals')
@endsection

@section('script')
<script src="{{ asset('js/imoViewer-min.js') }}"></script>
<script>
$('document').ready(function() {
    $('.submit-approval').on('click', function(){
        swal({
            title: "Approve Player",
            text: "Are you sure you want to approve this player application?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                $(this).closest('form').submit();
            }
        });
    })


    $('.submit-pending').on('click', function(){
        swal({
            title: "Return to Pending",
            text: "Are you sure you want to return this application to pending?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                $(this).closest('form').submit();
            }
        });
    })

    // $('.submit-disapprove').on('click', function(){
    //     swal({
    //         title: "Disapprove Player",
    //         text: "Input Remarks",
    //         icon: "info",
    //         content: "input",
    //         buttons: {
    //             cancel: true,
    //             confirm: true,
    //         }
    //     }).then((result) => {
    //         $('#remarks').val(result);
    //         if(result != null){
    //             if($('#remarks').val().length > 0){
    //                 $(this).closest('form').submit();
    //             }else{
    //                 swal({icon: "error", text : 'Please Enter Remarks to proceed'});
    //             }
    //         }
    //     });
    // })

    $('.btn-reject').on('click', function(){
        $('#form_reject').trigger("reset");
        $('#others1').hide();
        $('#others2').hide();
    })

    $('.reject-reason').on('change', function(){
        if($('.reject-reason:checked').prop('id') == 'reject-others1'){
            $('#others1').show();
            $('#others2').val('').hide();
        }else if($('.reject-reason:checked').prop('id') == 'reject-others2'){
            $('#others1').val('').hide();
            $('#others2').show();
        }else{
            $('#others1').val('').hide();
            $('#others2').val('').hide();
        }
    })

    $('.submit-disapprove').on('click', function(){
        swal({
            title: "Reject Application",
            text: "Are you sure you want to reject this application?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                if (typeof $('.reject-reason:checked').val() === "undefined") {
                    swal({
                        title: "Please select a reason!",
                        icon: "error",
                    })
                }else{
                    var textareaValue = '';
                    var remarks = '';
                    if($('.reject-reason:checked').prop('id') == 'reject-others1'){
                        textareaValue = $('#others1').val();
                        remarks = 'Remarks: ' + $('#others1').val();
                    }else if($('.reject-reason:checked').prop('id') == 'reject-others2'){
                        textareaValue = $('#others2').val();
                        remarks = 'Rejected-Remarks: ' + $('#others2').val();
                    }else{
                        textareaValue = $('.reject-reason:checked').val();
                        remarks = $('.reject-reason:checked').val();
                    }
                    if(textareaValue != ''){
                        $('#disapprove_remarks').val(remarks);
                        $('#form_reject').modal('hide');
                        $('#form_reject').submit();
                    }else{
                        swal({
                            title: "Please Enter Remarks!",
                            icon: "error",
                        })
                    }
                }
            }
        });
    })


    $('.btn-return').on('click', function(){
        $('#form_return').trigger("reset");
        $('#returnOthers').hide();
    })

    $('.return-reason').on('change', function(){
        if($('.return-reason:checked').prop('id') == 'return-others'){
            $('#returnOthers').val('').show();
        }else{
            $('#returnOthers').val('').hide();
        }
    })

    $('.submit-return').on('click', function(){
        swal({
            title: "Return Application",
            text: "Are you sure you want to return this application?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                if (typeof $('.return-reason:checked').val() === "undefined") {
                    swal({
                        title: "Please select a reason!",
                        icon: "error",
                    })
                }else{
                    var textareaValue = '';
                    var remarks = '';
                    if($('.return-reason:checked').prop('id') == 'return-others'){
                        textareaValue = $('#returnOthers').val();
                        remarks = 'Remarks: ' + $('#returnOthers').val();
                    }else{
                        textareaValue = $('.return-reason:checked').val();
                        remarks = $('.return-reason:checked').val();
                    }
                    if(textareaValue != ''){
                        $('#return_remarks').val(remarks);
                        $('#form_return').modal('hide');
                        $('#form_return').submit();
                    }else{
                        swal({
                            title: "Please Enter Remarks!",
                            icon: "error",
                        })
                    }
                }
            }
        });
    })

    $('.submit-review').on('click', function(){
        swal({
            title: "Submit Application",
            text: "Are you sure you want to submit this player application?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willUpdate) => {
            if (willUpdate) {
                $(this).closest('form').submit();
            }
        });
    })

    $('#file-input').imoViewer({
      'preview' : '#image-previewer',
    })
    $("#interview_date_time").datetimepicker({
        format: 'M d, Y h:i a',
        validateOnBlur: false,
        step: 10,
    });
});
function MyPrintFunction(id)
{
	var windowContent = '<!DOCTYPE html>';
	//Starting HTML Tags
	windowContent += '<html>'

	//Setting Print Page Title
	windowContent += '<head><title>Print Content</title></head>';

	//Starting Body Tag
	windowContent += '<body>'

	//Getting Div HTML
	windowContent +=  document.getElementById(id).innerHTML;

	//Closing Body Tag and HTML Tag
	windowContent += '</body>';
	windowContent += '</html>';

	//Calling Print Window
	var printWin = window.open('','','fullscreen=yes');

	//Opening Print Window
	printWin.document.open();

	//Adding Content in Print Window
	printWin.document.write(windowContent);

	//Closing Print Window
	printWin.document.close();

	//Focusing User to Print Window
	printWin.focus();

	//Calling Default Browser Printer
	printWin.print();

	//Closing Print Window
	printWin.close();
}
</script>
@endsection
