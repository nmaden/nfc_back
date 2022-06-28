<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeRequest;
use App\Http\Requests\RentRequest;
use App\Models\Office;
use App\Services\OfficeService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

   
    public $officeService;
    public function __construct(OfficeService $officeService)
    {
        $this->officeService =  $officeService;
    }

    public function index(OfficeRequest $request) {
        return $this->officeService->fetch($request);
    }

    public function store() {
        
    }

    public function update() {

    }
    public function show() {
        
    }

}
