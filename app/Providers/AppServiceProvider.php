<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Collections;

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
       $listprice = Collections::join('category', 'collections.tenphanloai', '=', 'category.tenphanloai')->select('collections.*', 'category.*')->orderBy('collections.min', 'asc')->get();
       
        View::share('listprice', $listprice);
        
        $select = Category::all();

        View::share('select', $select);
    }
}
