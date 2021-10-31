<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function index()
    {
        return $this->success(RestaurantResource::collection(Restaurant::all()));
    }

    public function show(Restaurant $restaurant)
    {
        return $this->success(new RestaurantResource($restaurant));
    }

    public function store(RestaurantStoreRequest $request)
    {
        $restaurant = Restaurant::query()->create([
            'name' => $request->get('name'),
            'type_id' => $request->get('type_id'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone_number'),
        ]);

        return $this->success(new RestaurantResource($restaurant));
    }

    public function update(RestaurantStoreRequest $request, Restaurant $restaurant)
    {
        $restaurant->update([
            'name' => $request->get('name'),
            'type_id' => $request->get('type_id'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone_number'),
        ]);
        return $this->success("Updating was successfully");
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return $this->success("Deletion was successfully");
    }
}
