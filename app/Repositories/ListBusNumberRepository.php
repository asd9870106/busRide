<?php

namespace App\Repositories;

use App\Models\ListBusNumber;
use DB;

class ListBusNumberRepository 
{
    protected $listBusNumber;

    public function __construct(
        ListBusNumber $listBusNumber,
    )
    {
        $this->listBusNumber = $listBusNumber;
    }
    
    public function createTable($data)
    {
        try {
            $table = $this->listBusNumber->create($data);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}
