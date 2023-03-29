<?php

namespace App\Services;

use App\Repositories\QrcodeRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Crypt;
use Storage;

class QrcodeService
{
    protected $qrcodeRepo;

    public function __construct(
        QrcodeRepository $qrcodeRepo
    )
    {
        $this->qrcodeRepo = $qrcodeRepo;
    }

    public function createStationQrcode($request)
    {
        
        // ---- 新增qrcode ---- //
        \Debugbar::info($request);
        foreach($request as $data) {         
            $station = $data['StationID'];   
            $url = 'http://127.0.0.1:8000/station/'. '?station=' . urlencode($station);
            $qrCode = QrCode::size(250)->generate($url);
            $this->qrcodeRepo->create([
                'station_id' => $data['StationID'],
                'station_name' => $data['StationName']['Zh_tw'],
                'station_address' => $data['StationAddress'],
                'qrcode_image' => $qrCode
            ]);
        }
    }

    public function getStationQrcode($stationId)
    {
        $tables = $this->qrcodeRepo->getStationQrcode($stationId);
        $data = array();
        \Debugbar::info($stationId);
        \Debugbar::info($tables);

        if(!$tables->isEmpty()){
            foreach($tables as $table){
                
                $data[] = [
                    // 活動類別
                    'station_id' => $table->station_id,
                    'station_name' => $table->station_name,
                    'station_address' => $table->station_address,
                    'qrcode_image' => $table->qrcode_image,
                ];
                
            }
            \Debugbar::info($data);
            return $data;
        }
        
        return null;
    }
}
