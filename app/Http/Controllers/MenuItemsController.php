<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Requests\MenuItemUpdateRequest;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Restaurant;

class MenuItemsController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $menuItems = MenuItem::query()->where('restaurant_id', $restaurant->id)->get();
        return $this->success(MenuItemResource::collection($menuItems));
    }

    public function show(Restaurant $restaurant, MenuItem $menuItem)
    {
        return $this->success(new MenuItemResource($menuItem));
    }

    public function store(MenuItemStoreRequest $request, Restaurant $restaurant)
    {
        /** @var MenuItem $menu_item */
        $menu_item = MenuItem::query()->create([
            'restaurant_id' => $restaurant->id,
            'food_id' => $request->get('food_id'),
        ]);
        $menu_item->categories()->attach($request->get('categories'));
        return $this->success(new MenuItemResource($menu_item));
    }

    public function update(MenuItemUpdateRequest $request, Restaurant $restaurant, MenuItem $menuItem)
    {
        $menuItem->update([
            'food_id' => $request->get('food_id'),
        ]);
        return $this->success('menu item is updated successfully');
    }

    public function destroy(Restaurant $restaurant, MenuItem $menuItem)
    {
        $menuItem->delete();
        return $this->success("menu item is deleted successfully");
    }
}
