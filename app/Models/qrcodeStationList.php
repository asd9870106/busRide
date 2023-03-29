<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcodeStationList extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'station_id',
        'station_name',
        'station_address',
        'qrcode_image'
    ];
}
