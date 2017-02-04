<?php

namespace App\Providers;

use App\Services\HDUService;
use App\Services\POJService;
use App\Services\ProblemService;
use Illuminate\Support\ServiceProvider;

class ProblemServiceProvider extends ServiceProvider
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

        $this->app->singleton('problem',function(){
            return new ProblemService();
        });

        $this->app->bind('App\Contracts\ProblemContract',function(){
            return new ProblemService();
        });

        foreach ($this->platforms as $key => $value)
        {
            $this->app->bind($key,function()use($value){
                return new $value();
            });
        }
    }
}
