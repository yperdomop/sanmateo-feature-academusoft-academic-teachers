<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
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
        Collection::macro('fromStdToArray', function () {
            return $this->map(function($value) {
                return (array) $value;
            });
        });

        Collection::macro('groupByKeys', function (Collection $secondCollection, string $keyName) {
            return $this->map(function($value, $key) use ($secondCollection, $keyName) {
                $valueToPut = (is_null($secondCollection->get($key))) ? [] : $secondCollection->get($key)->toArray();
                $value[$keyName] = $valueToPut;
                return $value;
            });
        });
    }
}
