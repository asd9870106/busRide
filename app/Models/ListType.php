<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListType extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'name'];

    public function rideType()
    {
        return $this->belongsToMany('App\Models\RideInformation')->using('App\Models\RideType');
    }
}
