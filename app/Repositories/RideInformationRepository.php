<?php

namespace App\Repositories;

use App\Models\RideInformation;
use DB;

class RideInformationRepository 
{
    protected $rideInformation;

    public function __construct(
        RideInformation $rideInformation,
    )
    {
        $this->rideInformation = $rideInformation;
    }
    
    public function createRideInfo($data)
    {
        // \Debugbar::info($data);
        try {
            DB::enableQueryLog();
            $table = $this->rideInformation->create($data);
            $statement = [
                'table' => $table,
                'statement' => DB::getQueryLog()
            ];
            DB::disableQueryLog();
            return $statement;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createDetail($table, $data)
    {
        try {
            $table->types()
                  ->attach($data['type']);
            $table->buses()
                  ->attach($data['bus']);
            $statement = ['statement' => DB::getQueryLog()];
            DB::disableQueryLog();
            return $statement;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    public function getStopDetail($stationId)
    {
        return $this->rideInformation->where('station_Id', $stationId)
                              ->select('id', 'station_id')
                              ->with('type')
                              ->with('bus')
                              ->get();
    }

    public function getTableById($id)
    {
        return $this->rideInformation->where('id', $id)
                              ->select('id', 'station_id')
                              ->first();
    }

    public function deleteTable($table)
    {
        try {
            $table->delete();
            $statement = ['statement' => DB::getQueryLog()];
            DB::disableQueryLog();
            return $statement;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteDetail($table)
    {
        try {
            $table->types()
                  ->detach();
            $table->buses()
                  ->detach();
            $statement = ['statement' => DB::getQueryLog()];
            DB::disableQueryLog();
            return $statement;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}
