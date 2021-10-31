<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'address',
        'phone_number'
    ];

    public function type()
    {
        return $this->belongsTo(RestaurantType::class, 'type_id');
    }
}
