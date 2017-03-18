<?php

namespace App\Providers;

use App\Services\HDUService;
use App\Services\PlatformService;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{

    private $platforms = [
            'HDU' =>\App\Services\HDUService::class,
            'POJ' =>\App\Services\POJService::class,
        ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->platforms as $key => $value)
        {
            $this->app->bind($key,function()use($value){
                return new $value();
            });
        }
    }
}
