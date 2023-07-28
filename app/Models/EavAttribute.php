<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EavAttribute extends Model
{
    use HasFactory;

    public function offices()
    {
        return $this->belongsToMany(Office::class, 'eav_values', 'eav_attribute_id', 'office_id')
            ->withPivot('value')
            ->where('code', 'services');
    }
}
