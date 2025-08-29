<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function  slots()
    {
        return $this->hasMany(Slot::class, 'bus_id', 'id');
    }
}
