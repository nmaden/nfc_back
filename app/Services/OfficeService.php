<?php
namespace App\Services;

use App\Http\Requests\OfficeSearchRequest;
use App\Http\Resources\OfficeResource;
use App\Models\EavAttribute;
use App\Models\Office;
use App\Models\Order;
use Illuminate\Support\Arr;

class OfficeService
{
    public function rent(RentRequest $request)
    {
        $office = Office::findOrFail($request->office_id);

        if (Order::where('office_id', $request->office_id)
            ->where('date', $request->date)
            ->exists()) {
            return response()->json([
                "message" => trans("messages.busy_office"),
            ], 422);
        }

        $order = new Order([
            'date' => $request->date,
            'client_id' => auth()->user()->id,
        ]);

        $office->orders()->save($order);

        return response()->json([
            "message" => trans("messages.book_success"),
        ], 200);
    }

    public function fetch(OfficeSearchRequest $request)
    {
        $office = Office::query();

        $servicesAttribute = EavAttribute::where('code', 'services')->first();
        if ($request->filled('services')) {
            $services = Arr::wrap($request->input('services'));
            $office->whereHas('services', function ($query) use ($servicesAttribute, $services) {
                $query->whereIn('value', $services)->where('eav_attribute_id', $servicesAttribute->id);
            });
        }

        if ($request->has('name')) {

            if ($request->has('name')) {
                $locale = app()->getLocale();
                $searchTerm = $request->input('name');

                $office->whereTranslation('name', 'like', '%' . $searchTerm . '%', null, $locale);
            }

            return OfficeResource::collection($office->paginate());
        }

        return OfficeResource::collection($office->paginate());
    }
}
