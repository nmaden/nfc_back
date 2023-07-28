<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Office extends Model
{
    use HasFactory,HasTranslations;


    public $translatable = ['name'];

    protected $fillable = ['name'];


    public function comments()
    {
        return $this->hasMany(OfficeComment::class,'office_id','id');
    }

    public function services()
    {
        return $this->belongsToMany(EavAttribute::class, 'eav_values', 'office_id', 'eav_attribute_id')
            ->withPivot('value')
            ->where('code', 'services');
    }

}
