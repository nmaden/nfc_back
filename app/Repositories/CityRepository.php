<?php
namespace App\Repositories;

use App\Models\City;
use Illuminate\Pagination\LengthAwarePaginator;

class CityRepository
{
    public function getAllCitiesPaginated(): LengthAwarePaginator
    {
        return City::paginate(10);
    }

    public function create(array $attributes)
    {
        return City::create($attributes);
    }
}
