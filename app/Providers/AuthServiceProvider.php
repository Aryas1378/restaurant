<?php

namespace App\Providers;

use App\Models\FeedBack;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Photo;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Policies\FeedBackPolicy;
use App\Policies\FoodCategoryPolicy;
use App\Policies\FoodPolicy;
use App\Policies\MenuItemPolicy;
use App\Policies\MenuPolicy;
use App\Policies\PhotoPolicy;
use App\Policies\RestaurantPolicy;
use App\Policies\TypePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        RestaurantType::class => TypePolicy::class,
        Food::class => FoodPolicy::class,
        FoodCategory::class => FoodCategoryPolicy::class,
        Photo::class => PhotoPolicy::class,
        FeedBack::class => FeedBackPolicy::class,
        Restaurant::class => RestaurantPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
