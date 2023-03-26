<?php

namespace App\Services;

use App\Repositories\RideInformationRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use Storage;

class RideInformationService
{
    protected $rideInformationRepo;

    public function __construct(
        RideInformationRepository $rideInformationRepo
    )
    {
        $this->rideInformationRepo = $rideInformationRepo;
    }

    public function createRideInfo($request)
    {
        // ---- 主表新增 ---- //
        $createTable = $this->rideInformationRepo->createRideInfo([
            'station_id' => $request->stationId,
            'station_name' => $request->station_name,
        ]);
        
        // ---- 複選選項打包 ---- //
        if (isset($createTable['statement'])) { 
            
            $items = [
                // 方式
                'type' => $request->type,
                // 車次
                'bus' => $request->number,
            ];
            $createDetail = $this->rideInformationRepo->createDetail($createTable['table'], $items);
            \Debugbar::info($items);
        }
        
    }
    public function getStopDetail($id)
    {
        $tables = $this->rideInformationRepo->getStopDetail($id);
        $data = array();
        

        if(!$tables->isEmpty()){
            foreach($tables as $table){
                
                foreach ($table->type as $type) {
                    $types[] = $type->list_type_id;
                }
                foreach ($table->bus as $bus) {
                    $buses[] = $bus->bus_number;
                }
                $data[] = [
                    // 活動類別
                    'id' => $table->id,
                    'station_id' => $table->station_id,
                    'type' => $types,
                    'buses' => $buses
                ];
                $types = array();
                $buses = array();
                
            }
            \Debugbar::info($data);
            return $data;
        }
        
        return null;
    }

    public function deleteTable($id) 
    {
        // 附表(關聯選項) 刪除
        \Debugbar::info($id);
        $table = $this->rideInformationRepo->getTableById($id);
        \Debugbar::info($table);
        if($table) {
            $deletedDetail = $this->rideInformationRepo->deleteDetail($table);
            if (isset($deletedDetail['statement'])) {
                // 主表刪除
                $deletedTable = $this->rideInformationRepo->deleteTable($table);
            }
        }

        return null;
    }
}
