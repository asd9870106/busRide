<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\RideInformationService;
use App\Services\StationService;

use Auth;
class StationBusController extends Controller
{
    protected $rideInformationService,
              $StationService;


    public function __construct(
        RideInformationService $rideInformationService,
        StationService $StationService,
    )
    {
        $this->rideInformationService = $rideInformationService;
        $this->StationService = $StationService;
    }

    public function main()
    {
        return view('station.setStationQrcode');
    }

    public function busQrcode()
    {
        return view('station.setBusQrcode');
    }
    
    public function sendStationId(Request $request)
    {
        $stationId = $request->input('stationId');
        // 在這裡處理 stationId 的邏輯
    }

    public function detail()
    {
        return view('station.stationId');
    }

    public function example()
    {
        return view('station.example');
    }

    public function qrcode()
    {
        // echo QrCode::size(200)->generate(Request::url());
        return view('qrcode_test');
    }


    public function create(Request $request)
    {
        $created = $this->rideInformationService->createRideInfo($request);
        // \Debugbar::info($request);
        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }
    // 取得站牌的stationId
    public function getStationId(Request $request) {

        $station = $request->station;
        $table = $this->StationService->getStationId($station);
        if ($table) {
            return response($table, 200);
        }
        return response('', 404);
    }
    
    public function getBusRoute(Request $request) {

        $station = $request->station;
        $table = $this->StationService->getStationId($station);
        if ($table) {
            return response($table, 200);
        }
        return response('', 404);
    }

    public function generate(Request $request) {
        $request->validate([
            'station' => 'required|string',
        ]);

        $station = $request->input('station');
        $url = 'http://127.0.0.1:8000/station/'. '?station=' . urlencode($station);
        $qrCode = QrCode::size(250)->generate($url);

        return view('qrcode.generate', compact('station', 'qrCode'));
    }

    public function getBusQrcode(Request $request) {
        $request->validate([
            'route' => 'required|string',
            'busName' => 'required|string',
        ]);
        \Debugbar::info($request);
        $route = $request->input('route');
        $busName = $request->input('busName');
        $url = 'http://127.0.0.1:8000/driver/'. '?route=' . urlencode($route) . '&busName=' . urlencode($busName);
        $qrCode = QrCode::size(250)->generate($url);

        return view('station.test', compact('route', 'busName', 'qrCode'));
    }
    
}
