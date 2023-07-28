<?php
namespace App\Repositories;

use App\Models\Office;

class OfficeRepository
{
    public function create(array $attributes)
    {
        return Office::create($attributes);
    }
}
