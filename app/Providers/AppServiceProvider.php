<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('valid_enum', function ($attribute, $value, $parameters, $validator) {
        $enumValues = ['upcoming', 'active', 'completed']; 
          return in_array($value, $enumValues);
});

    }
}
