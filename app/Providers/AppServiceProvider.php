<?php

namespace App\Providers;

use App\Models\Category;
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
        view()->composer('web/components/header',function ($view){
            $cate = Category::all();
            $view->with('cate',$cate);
        });
        view()->composer('web/cate',function ($view){
            $cate = Category::all();
            $view->with('cate',$cate);
        });
    }
}
