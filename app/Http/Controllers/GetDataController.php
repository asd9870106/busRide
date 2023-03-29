<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListType;
use App\Models\RideBusNumber;
use App\Services\ListBusNumberService;
use App\Services\StationService;
use App\Services\QrcodeService;

class GetDataController extends Controller
{
    protected $listBusNumberService,
              $StationService,
              $QrcodeService;

    public function __construct(
        ListBusNumberService $listBusNumberService,
        StationService $StationService,
        QrcodeService $QrcodeService
    )
    {
        $this->listBusNumberService = $listBusNumberService;
        $this->StationService = $StationService;
        $this->QrcodeService = $QrcodeService;
    }

    // 取得台北市公車到站資料
    public function getTaipeiStop(Request $request) {
        // \Debugbar::info($request);
        $data = $request->stationId;
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
        
        // 取得台北市公車到站資料
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://tdx.transportdata.tw/api/advanced/v2/Bus/EstimatedTimeOfArrival/City/Taipei/PassThrough/Station/$data?%24top=30&%24format=JSON");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }
    // 取得台北市公車到站資料
    public function getNewTaipeiStop(Request $request) {
        // \Debugbar::info($request);
        $data = $request->stationId;
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
        
        // 取得新北市公車到站資料
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://tdx.transportdata.tw/api/advanced/v2/Bus/EstimatedTimeOfArrival/City/NewTaipei/PassThrough/Station/$data?%24top=30&%24format=JSON");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }

    public function getBusStation() {
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
        
        // 取得台北市站位資料
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tdx.transportdata.tw/api/basic/v2/Bus/Station/City/Taipei?%24select=StationAddress%2CStationID%2CStationName&%24orderby=StationID&%24format=JSON');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }

    public function getBusNumber() {
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
        
        // 取得台北市路線資料
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tdx.transportdata.tw/api/basic/v2/Bus/Route/City/Taipei?%24select=RouteID%2CRouteName%2CCity&%24format=JSON');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Bearer '.$access_token));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $busEstimatedTime = curl_exec($ch);
        curl_close($ch);
        return $busEstimatedTime;
    }

    public function setQrCode(){
        $qrcode = QrCode::size(200)->generate(Request::url());
        return $qrcode;
    }

    public function create(Request $request) {

        $created = $this->StationService->create($request->data);
        // Response
        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }

    public function createBusNumber(Request $request) {

        $created = $this->listBusNumberService->createTable($request->data);
        // Response
        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }

    public function index() {
        return view('createTable');
    }

    public function createStationQrcode(Request $request) {
        // \Debugbar::info($request);
        $created = $this->QrcodeService->createStationQrcode($request->data);

        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }

    public function getStationQrcode(Request $request) {
        \Debugbar::info($request);
        $table = $this->QrcodeService->getStationQrcode($request->station_name);
        \Debugbar::info($table);
        
        
        return $table;
    }

    public function createDriverQrcode() {
        \Debugbar::info($request);
        $route = $request->input('route');
        $busName = $request->input('busName');
        $url = 'http://127.0.0.1:8000/driver/'. '?route=' . urlencode($route) . '&busName=' . urlencode($busName);
        $qrCode = QrCode::size(250)->generate($url);
    }

    public function getDriverQrcode(Request $request) {
        // $table = $this->QrcodeService->getStationQrcode($request);
    }

}
