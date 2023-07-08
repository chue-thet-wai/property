<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        
        view()->composer('properties.*',function($view){
            $view->with('categories',config('constants.categories'));
            $view->with('protypes',config('constants.protypes'));
            $view->with('features',config('constants.features'));
        });
       
        view()->composer('components.table',function($view){
            $view->with('categories',config('constants.categories'));
            $view->with('protypes',config('constants.protypes'));
            $view->with('features',config('constants.features'));
            $view->with('enquirytypes',config('constants.enquirytypes'));
            $view->with('propertylocation',config('constants.propertylocation'));
        });
        
        view()->composer('customers.*',function($view){
            $view->with('enquirytypes',config('constants.enquirytypes'));
        });

        view()->composer('properties.*',function($view){
            $view->with('status',config('constants.status'));
            $view->with('propertylocation',config('constants.propertylocation'));
            $view->with('tenureproperty',config('constants.tenureproperty'));
        });

    }
}
