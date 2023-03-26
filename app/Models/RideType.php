<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideType extends Model
{
    use HasFactory;
    protected $table = 'ride_types';
    protected $guarded = ['ride_info_id'];
    protected $fillable = ['list_type_id'];

}
