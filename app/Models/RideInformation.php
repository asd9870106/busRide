<?php

namespace App\Models;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;


class rideInformation extends Model
{
    use HasFactory;
    protected $table = 'ride_information';
    protected $fillable = [
        'station_id',
        'station_name',
    ];

    public function __construct()
    {
        Relation::morphMap([
            'types' => 'App\Models\RideType',
            'buses' => 'App\Models\RideBusNumber',
        ]);
    }

    public function station() 
    {
        return $this->belongsTo('App\Models\station', 'station_id', 'station_id');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\ListType', 'App\Models\RideType', 'ride_info_id', 'list_type_id')->withPivot("id")->withTimestamps();
    }
    
    public function buses()
    {
        return $this->belongsToMany('App\Models\ListBusNumber', 'App\Models\RideBusNumber', 'ride_info_id', 'bus_number')->withPivot("id")->withTimestamps();
    }
    
    public function bus()
    {
        return $this->hasMany('App\Models\RideBusNumber', 'ride_info_id');
    }

    public function type()
    {
        return $this->hasMany('App\Models\RideType', 'ride_info_id');
    }
}
