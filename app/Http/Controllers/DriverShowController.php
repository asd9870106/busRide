<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RideInformationService;
use Auth;
class DriverShowController extends Controller
{
    protected $rideInformationService;

    public function __construct(
        RideInformationService $rideInformationService,
    )
    {
        $this->rideInformationService = $rideInformationService;
    }

    public function main()
    {
        return view('driver.driver');
    }

    public function getStopDetail(Request $request)
    {
        $id = $request->stationId;
        $table = $this->rideInformationService->getStopDetail($id);
        // \Debugbar::info($table);
        // Response
        // return $table;
        if ($table) {
            return response($table, 200);
        }
        return response('', 404);
    }

    public function delete(Request $request)
    {
        // \Debugbar::info($request->id);
        $deleted = $this->rideInformationService->deleteTable($request->id);
            // Response
            if (isset($deleted['result'])) {
                if ($deleted['result'] === 'Successful') {
                    return response('Successful', 200);
                } elseif ($deleted['result'] === 'Failed') {
                    return response('Server Error', 500);
                }
            }
    }
}
