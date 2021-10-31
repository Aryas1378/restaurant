<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodStoreRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;

class FoodController extends Controller
{

    public function index()
    {
        $foods = Food::all();
        return $this->success(FoodResource::collection($foods));
    }

    public function show(Food $food)
    {
        return $this->success(new FoodResource($food));
    }

    public function store(FoodStoreRequest $request)
    {
        $food = Food::query()->create([
            'name' => $request->get('name'),
        ]);

        return $this->success(new FoodResource($food));
    }

    public function update(FoodStoreRequest $request, Food $food)
    {
        $food->update([
            'name' => $request->name,
        ]);
        return $this->success("Update was successfully");
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return $this->success('Deletion was successful');
    }
}
