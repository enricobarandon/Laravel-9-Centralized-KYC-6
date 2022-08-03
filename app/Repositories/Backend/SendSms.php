<?php

namespace App\Repositories\Backend;

use App\Models\ActivityLog;

class SendSms
{
    static function send($form)
    {
        $auth = auth()->user();

        $curl = curl_init();
        // dd($form);
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
            'formNumber' => $form['number'],
            'formMessage' => $form['message'],
            'formPriority' => '1',
            'formNotificationType' => 'sms',
            'formEmail' => 'erwin.dorado@alpharedph.net'
        ),
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: ' . env('SMS_API_KEY'),
            'X-API-USERNAME: ' . env('SMS_API_USERNAME'),
            'X-API-PASSWORD: ' . env('SMS_API_PASSWORD'),
            'Authorization: Basic bHVja3k4c3Q0cjohbHVja3k4JHQ0UiQkQVBJNGNjM3NzQCUk'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // echo $response;
        // dd($response);
        // if ($response) {

        $decodedResponse = json_decode($response, true);
        
        if ($decodedResponse['response'] === false) {
            ActivityLog::create([
                'type' => 'sms-failed',
                'user_id' => $auth->id,
                'assets' => json_encode(array_merge([
                    'action' => 'Sms failed',
                ],$decodedResponse, $form))
            ]);
        }

        // }
    }

    private static $messageArr = [
        'set_interview' => 'Good day. '
    ];
}