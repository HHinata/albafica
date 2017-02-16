<?php

namespace App\Providers;

use App\Services\HDUService;
use App\Services\PlatformService;
use App\Services\POJService;
use App\Services\ProblemService;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{

    private $platforms = [
            'HDU' =>\App\Services\HDUService::class,
            'POJ' =>\App\Services\POJService::class
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

        $this->app->singleton('platform',function(){
            return new PlatformService();
        });

        $this->app->bind('App\Contracts\PlatformServiceContract',function(){
            return new PlatformService();
        });

        foreach ($this->platforms as $key => $value)
        {
            $this->app->bind($key,function()use($value){
                return new $value();
            });
        }
    }
}
