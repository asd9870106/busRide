<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'station_id',
        'station_name',
        'station_address',
        'position_lat',
        'position_lon',
    ];
}
