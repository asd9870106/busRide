<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListType;
use App\Models\RideBusNumber;
use App\Services\ListBusNumberService;
use App\Services\StationService;
use Auth;

class JsonImportController extends Controller
{
    protected $listBusNumberService,
              $StationService;

    public function __construct(
        ListBusNumberService $listBusNumberService,
        StationService $StationService
    )
    {
        $this->listBusNumberService = $listBusNumberService;
        $this->StationService = $StationService;
    }

    public function index()
    {
        $json = file_get_contents(storage_path('taipeiBus.json'));
        $data = json_decode($json,true);
        // Create Table
        $created = $this->listBusNumberService->createTable($data);
        // Response
        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }

    public function createStation()
    {
        $json = file_get_contents(storage_path('taipeiStaiton.json'));
        $data = json_decode($json,true);
        // Create Table
        $created = $this->StationService->create($data);
        // Response
        if (isset($created['result'])) {
            if ($created['result'] === 'Successful') {
                return response('Successful', 200);
            } elseif ($created['result'] === 'Failed') {
            return response('Server Error', 500);
            }
        } 
    }
    
}
