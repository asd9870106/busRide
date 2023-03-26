<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBusNumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'routeID',
        'city',
        'name',
    ];
    
    public function rideBusNumber()
    {
        return $this->belongsToMany("App\Models\RideBusNumber");
    }
    
}
