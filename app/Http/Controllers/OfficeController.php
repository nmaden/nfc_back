<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Http\Requests\OfficeSearchRequest;
use App\Repositories\OfficeRepository;
use App\Services\OfficeService;

class OfficeController extends Controller
{
    public $officeService;
    public $officeRepository;

    public function __construct(OfficeService $officeService,OfficeRepository $officeRepository)
    {
        $this->officeService =  $officeService;
        $this->officeRepository = $officeRepository;
    }

    public function index(OfficeSearchRequest $request) {
        return $this->officeService->fetch($request);
    }

    public function store(OfficeRequest $request) {
        $attributes = [
            'name' => [
                'en' => $request->ru_name,
                'ru' => $request->en_name
            ],
        ];

        return $this->officeRepository->create($attributes);
    }
}
