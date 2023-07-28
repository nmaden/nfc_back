<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    public $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository =  $cityRepository;
    }

    public function index(): LengthAwarePaginator {
        return $this->cityRepository->getAllCitiesPaginated();
    }

    public function store(CityRequest $request):JsonResponse {
        $attributes = [
            'name' => [
                'en' => $request->input('name_en'),
                'ru' => $request->input('name_ru'),
            ]
        ];

        return $this->cityRepository->create($attributes);
    }
}
