<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ExtendedValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
            /*
             * $parameters[0]   table name the uniqueness should be checked on.
             * $parameters[1]   the unique attribute (just as original unique)
             * $parameters[2]   second attribute that should be also unique with the given value
             * $parameters[3]   value of the second attribute
             */
        Validator::extend('uniqueWith', function ($attribute, $value, $parameters) {

            $alreadyExists = \DB::table($parameters[0])
                ->where($parameters[1], 'LIKE', $value)
                ->where($parameters[2], 'LIKE', $parameters[3])
                ->whereNull('deleted_at')
                ->count() ;

            return !$alreadyExists;
        });
    }
}
