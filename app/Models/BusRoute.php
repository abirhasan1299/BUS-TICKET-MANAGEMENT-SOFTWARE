<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $guarded=[];
    public function slot()
    {
        return $this->hasMany(Slot::class,'route_id','id');
    }
}
