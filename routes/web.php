<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ProcessBlackListDetected;
use App\Events\BlackListDetected;
use App\Events\DuplicateDetected;
use App\Models\ActivityLog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
//     // echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('login.page');

Route::get('/terms', [App\Http\Controllers\Auth\RegisterController::class, 'terms'])->name('players.terms-condition');
Route::get('/policy', [App\Http\Controllers\Auth\RegisterController::class, 'policy'])->name('players.privacy-policy');

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    
    Route::middleware('role:Administrator')->group(function(){
        Route::get('/api-data', [App\Http\Controllers\ApiDataController::class, 'index'])->name('api-data.index');
        Route::post('/api-data/groups', [App\Http\Controllers\ApiDataController::class, 'getGroups'])->name('api.getGroups');
        
        Route::get('/activity-logs', [App\Http\Controllers\ActivityLogsController::class, 'index'])->name('activitylogs.index');
    });

    Route::get('test', function(){
        $auth = auth()->user();
        // ProcessBlackListDetected::dispatch(6);
        // event(new DuplicateDetected(30));
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sms.lucky8star.com/api/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'formNumber' => '09261316513',
            'formMessage' => 'test',
            'formPriority' => '1',
            'formNotificationType' => 'sms',
            'formEmail' => 'erwin.dorado@alpharedph.net'),
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: ' . env('SMS_API_KEY'),
            'X-API-USERNAME: ' . env('SMS_API_USERNAME'),
            'X-API-PASSWORD: ' . env('SMS_API_PASSWORD'),
            'Authorization: Basic bHVja3k4c3Q0cjohbHVja3k4JHQ0UiQkQVBJNGNjM3NzQCUk'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);
        if ($response['response'] === false) {
            ActivityLog::create([
                'type' => 'sms-failed',
                'user_id' => $auth->id,
                'assets' => json_encode(array_merge([
                    'action' => 'Sms failed',
                ],$response))
            ]);
        }

        // echo $response;
    });
    
});

