<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'food_id',
    ];

    public function foods()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function categories()
    {
        return $this->belongsToMany(FoodCategory::class, 'menu_item_categories', 'menu_item_id', 'category_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
