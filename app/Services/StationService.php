<?php

namespace App\Services;

use App\Repositories\StationRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use Storage;

class StationService
{
    protected $stationRepo;

    public function __construct(
        StationRepository $stationRepo
    )
    {
        $this->stationRepo = $stationRepo;
    }

    public function create($request)
    {
        // ---- 新增/更新主表 ---- //
        foreach($request as $data) {            
            $this->stationRepo->create([
                'station_id' => $data['StationID'],
                'station_name' => $data['StationName']['Zh_tw'],
                'station_address' => $data['StationAddress']
            ]);
        }
    }
}
