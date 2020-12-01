<?php


namespace App\Http\Traits;


use App\Address;
use App\Models\FcmToken;
use App\Models\User;
use Illuminate\Http\Request;

trait FirebasOperation
{
    public function getFcmTokenAndroidAttribute()
    {
        $android_token = $this->tokens()->where('device', 'android')->first();
        if (!$android_token) return "";
        return $android_token->token;
    }

    public function getFcmTokenIosAttribute()
    {
        $ios_token = $this->tokens()->where('device', 'ios')->first();
        if (!$ios_token) return "";
        return $ios_token->token;
    }

    public function getFcmTokenWebAttribute()
    {
        $web_token = $this->tokens()->where('device', 'desktop')->get();
        if (!$web_token) return "";
        return $web_token->toArray();
    }


    function fire($title, $body, $data, $users)
    {
        $android_tokens = $users->pluck('fcm_token_android');
        $ios_tokens = $users->pluck('fcm_token_ios');
        $users_id = $users->pluck('id');
        $web_tokens = FcmToken::whereIn('user_id', $users_id)->where('device', 'desktop')->get()->pluck('token')->toArray();
        $this->notifyByFirebase($title, $body, $android_tokens, $data, false);
        $this->notifyByFirebase($title, $body, $web_tokens, $data, false);
        $this->notifyByFirebase($title, $body, $ios_tokens, $data, true);
    }


    function notifyByFirebase($title, $body, $tokens, $data = [], $is_notification = true)
    {
        $registrationIDs = $tokens;
        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'data' => $data
        );
        if ($is_notification) {
            $fcmFields['notification'] = $fcmMsg;
        }

        $headers = array(
            'Authorization: key=' . $this->fcm_server_key(),
            'Content-Type: application/json'
        );

        info("API_ACCESS_KEY_client: " . env('API_ACCESS_KEY_client'));
        info("PUSHER_APP_ID: " . env('PUSHER_APP_ID'));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    function fcm_server_key()
    {
        return 'AAAAiTlRmGw:APA91bGRW2y7HH9Z3HrACHeMuP5ZDj9fXkbx-TEyVuDIRrAsJ0NDkkaYqjdwkaIN5YmvAhKVMWOs2jfNvH0l-TxLNeEn8MDkiftAhaXoV0wij4kl-YRuT0PtB_UZC3lz8DIHx8fGO4-D';

    }
}
