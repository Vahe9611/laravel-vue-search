<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\Hotels;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * @return Hotels
     */
    public function index(): Hotels
    {
        return new Hotels(Hotel::all());
    }

    public function search(SearchRequest $request)
    {
        $hotels = Hotel::query();

        if ($request->has('name')) {
            $query = trim($request->name);
            $hotels = $hotels->where('name', 'LIKE', '%'.$query.'%');
        }

        if ($request->has('bathrooms')) {
            $hotels = $hotels->where('bathrooms', (int) $request->bathrooms);
        }

        if ($request->has('bedrooms')) {
            $hotels = $hotels->where('bedrooms', (int) $request->bedrooms);
        }

        if ($request->has('garages')) {
            $hotels = $hotels->where('garages', (int) $request->garages);
        }

        if ($request->has('storeys')) {
            $hotels = $hotels->where('storeys', (int) $request->storeys);
        }

        $price = json_decode($request->price);

        if ($request->has('price')) {
            $hotels = $hotels->where('price', '>=', $price->start);

            $hotels = $hotels->where('price', '<=', $price->end);
        }

        return new Hotels($hotels->get());
    }
}
