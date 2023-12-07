<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Log;

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
        // verified_age VALIDATION FUNCTION
        Validator::extend('verified_age', function ($attribute, $value, $parameters, $validator) {
            $minAge = 18;
            $maxAge = 100;

            $birthdate = Carbon::parse($value);
            $age = $birthdate->age;

            return $age >= $minAge && $age <= $maxAge;
        });

        Validator::replacer('verified_age', function ($message, $attribute, $rule, $parameters) {
            Log::info("Message: $message");
            return str_replace([':min', ':max'], [18, 100], $message);
        });
    }
}
