<?php

namespace App\Services;

use App\Http\Resources\CarRentResource;
use App\Http\Resources\OfficeResource;
use App\Models\CarsToRent;
use App\Models\Lecture;
use App\Models\Office;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;
   

class OfficeService 
{
    public $office;
    public function __construct(Office $office)
    {
        $this->office =  $office;
    }
    public function rent($request,$id) {
        $office = Office::where('id',$id)->first();
        if(!$office) {
            return response()->json([
                "message"   => trans("messages.invalid_office"),
            ], 422);
        }

        $existOrder = Order::where('office_id',$id)->where('date',$request->date)->first();
        if($existOrder) {
            return response()->json([
                "message"   => trans("messages.busy_office"),
            ], 422); 
        }

        $order = new Order();
        $order->office_id = $id;
        $order->date = $request->date;
        $order->save();

        return response()->json([
            "message"   => trans("messages.book_success"),
        ], 200);
    }
    public function fetch($request) {
        
        $office = $this->office;

        if($request->filled('area')) {
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('area','>=',$request->area);
            });
        }
        if($request->filled('city_id')) {
            
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('city_id',$request->city_id);
            });
        }
        if($request->filled('count_seats')) {
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('count_seats',$request->count_seats);
            });
        }
        if(Str::contains($request->service,1)) {
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('wifi',1);
            });
        }
        if(Str::contains($request->service,3)) {
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('coffee_machine',1);
            });
        }
        if(Str::contains($request->service,2)) {
            
            $office->whereHas('attributes', function ($attribute) use($request)  {
                return $attribute->where('tv',1);
            });
        }
        // if($request->has('name')) {
        //     $office->where('name','like','%'.$request->name.'%');
        // }


        return OfficeResource::collection($office->paginate());   
    }
}
