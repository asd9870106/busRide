<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use Storage;

class GetDataService
{

    public function getPlanRoute($userLat, $userLon, $desLat, $desLon)
    {
        // 取得 Access Token
        $client_id = env('CLIENT_ID_KEY');
        $client_secret = env('CLIENT_SECRET_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tdx.transportdata.tw/auth/realms/TDXConnect/protocol/openid-connect/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&client_id='.$client_id.'&client_secret='.$client_secret);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        $access_token = json_decode($result,1)['access_token'];

        // 取得附近站牌
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://tdx.transportdata.tw/api/maas/routing?origin=$userLat%2C%20$userLon&destination=$desLat%2C%20$desLon&gc=0.5&top=5&transit=5&transfer_time=5%2C30&first_mile_mode=0&first_mile_time=5&last_mile_mode=0&last_mile_time=5");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }

}
