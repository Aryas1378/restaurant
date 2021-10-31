<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodCategoryStoreRequest;
use App\Http\Resources\FoodCategoryResource;
use App\Models\FoodCategory;

class FoodCategoryController extends Controller
{

    public function index()
    {
        $foods_categories = FoodCategory::all();
        return $this->success(FoodCategoryResource::collection($foods_categories));
    }

    public function show(FoodCategory $foodCategory)
    {
        return $this->success(new FoodCategoryResource($foodCategory));
    }

    public function store(FoodCategoryStoreRequest $request)
    {
        $food_category = FoodCategory::query()->create([
            'name' => $request->name,
        ]);
        return $this->success(new FoodCategoryResource($food_category));
    }

    public function update(FoodCategoryStoreRequest $request, FoodCategory $foodCategory)
    {

        $foodCategory->update([
            'name' => $request->get('name'),
        ]);
        return $this->success("Updated successfully");
    }

    public function destroy(FoodCategory $foodCategory)
    {
        $foodCategory->delete();
        return $this->success("Deletion was successfully");
    }
}
