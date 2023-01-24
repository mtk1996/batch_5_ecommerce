<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::share('category', Category::withCount('product')->get());
        View::share('brand', Brand::withCount('product')->get());

        View::composer('*', function ($view) {
            $cart_qty = Cart::where('user_id', auth()->id())->count();
            $view->with('cart_qty', $cart_qty);
        });
    }
}
