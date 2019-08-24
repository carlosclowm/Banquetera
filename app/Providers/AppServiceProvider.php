<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use DB;


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
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) 
    {
        if (Auth::user()!= null) {
            $Calendar = DB::table('calendario')->where('usuario','=',Auth::user()->id)->get();
        //...with this variable
        $view->with('Calendario', $Calendar);  
        }
          
    });
    }
}
