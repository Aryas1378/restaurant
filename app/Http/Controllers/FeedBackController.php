<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackStoreRequest;
use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Resources\FeedBackResource;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function store(FeedBackStoreRequest $request, MenuItem $menuItem)
    {
        $feedBack = $menuItem->feedbacks()->create([
            'description' => $request->get('description')
        ]);
        return $this->success(new FeedBackResource($feedBack));
    }
}
