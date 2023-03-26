<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideBusNumber extends Model
{
    use HasFactory;
    protected $table = 'ride_bus_numbers';
    protected $guarded = ['ride_info_id'];
    protected $fillable = ['bus_number'];
    
    
}

