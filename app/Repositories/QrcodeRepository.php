<?php

namespace App\Repositories;

use App\Models\qrcodeDriverList;
use App\Models\qrcodeStationList;
use DB;

class QrcodeRepository 
{
    protected $qrcodeDriverList,
              $qrcodeStationList;

    public function __construct(
        qrcodeDriverList $qrcodeDriverList,
        qrcodeStationList $qrcodeStationList,
    )
    {
        $this->qrcodeDriverList = $qrcodeDriverList;
        $this->qrcodeStationList = $qrcodeStationList;
    }
    
    public function create($data)
    {
        try {
            $table = $this->qrcodeStationList->create($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getStationQrcode($data)
    {
        return $this->qrcodeStationList->where('station_name', $data)
                              ->get();
    }

}
