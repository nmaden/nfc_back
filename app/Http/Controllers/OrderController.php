<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentRequest;
use App\Models\Order;
use App\Services\OfficeService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $officeService;
    public function __construct(OfficeService $officeService)
    {
        $this->officeService =  $officeService;
    }
    public function index() {
        return Order::with(['client','office.attributes.city'])->paginate();
    }
    public function store(RentRequest $request) {
        return $this->officeService->rent($request);
    }
}
