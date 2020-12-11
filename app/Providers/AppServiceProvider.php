<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
        if (env("APP_DEBUG"))
        {
            DB::listen(function ($query) {
                // echo("DB: " . $query->sql . "[".  implode(",",$query->bindings). "]\n");
            });
        }
    
    }
}
