<?php

namespace App\Services;

use App\Repositories\ListBusNumberRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
use Storage;

class ListBusNumberService
{
    protected $listBusNumberRepo;

    public function __construct(
        ListBusNumberRepository $listBusNumberRepo
    )
    {
        $this->listBusNumberRepo = $listBusNumberRepo;
    }

    public function createTable($request)
    {
        // ---- 新增/更新主表 ---- //
        foreach($request as $data) {            
            $this->listBusNumberRepo->createTable([
                'routeID' => $data['RouteID'],
                'city' => $data['City'],
                'name' => $data['RouteName']['Zh_tw']
            ]);
        }
    }
}
