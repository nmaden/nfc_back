<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->hasOne(Cities::class,'id','city_id');
    }
}
