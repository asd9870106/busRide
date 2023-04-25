<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function nearby() {
        return view('search.nearby');
    }
    public function destination() {
        return view('search.destination');
    }
    public function getNearbyStation(Request $request) {
        $LAT = $request->LAT;
        $LON = $request->LON;
        $distance = $request->DistanceInMeters;
        // \Debugbar::info($distance);

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
        curl_setopt($ch, CURLOPT_URL, "https://tdx.transportdata.tw/api/advanced/v2/Bus/Station/NearBy?%24spatialFilter=nearby%28$LAT%2C%20$LON%2C%20$distance%29&%24format=JSON");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }

    public function getDestinationStation() {

    }
}
