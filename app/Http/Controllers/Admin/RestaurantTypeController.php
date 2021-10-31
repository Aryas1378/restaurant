<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantTypeStoreRequest;
use App\Http\Resources\RestaurantTypeResource;
use App\Models\RestaurantType;
use Illuminate\Http\Request;

class RestaurantTypeController extends Controller
{

    public function index()
    {
        $restaurant_types = RestaurantType::all();
        return $this->success(RestaurantTypeResource::collection($restaurant_types));
    }

    public function show(RestaurantType $restaurantType)
    {
        return $this->success(new RestaurantTypeResource($restaurantType));
    }

    public function store(RestaurantTypeStoreRequest $request)
    {
        $restaurant_type = RestaurantType::query()->create([
            'name' => $request->get('name'),
        ]);

        return $this->success(new RestaurantTypeResource($restaurant_type));
    }

    public function update(RestaurantTypeStoreRequest $request, RestaurantType $restaurantType)
    {
        $restaurantType->update([
            'name' => $request->name,
        ]);
        return $this->success("Update was successfully");
    }
}
