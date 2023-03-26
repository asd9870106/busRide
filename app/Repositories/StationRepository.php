<?php

namespace App\Repositories;

use App\Models\Station;
use DB;

class StationRepository 
{
    protected $station;

    public function __construct(
        Station $station
    )
    {
        $this->station = $station;
    }
    
    public function create($data)
    {
        try {
            $table = $this->station->create($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}
