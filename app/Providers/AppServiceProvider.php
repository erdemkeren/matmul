<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\NumberToStringConverters\NumberToLetterConverter;
use App\Services\NumberToStringConverters\NumberToStringConverterContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            NumberToStringConverterContract::class,
            NumberToLetterConverter::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
