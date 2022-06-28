<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public function attributes()
    {
        return $this->hasOne(Attributes::class,'office_id','id');
    }

    public function comments()
    {
        return $this->hasMany(OfficeComments::class,'office_id','id');
    }
}
