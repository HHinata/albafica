<?php

namespace App\Providers;

use App\Services\ProblemService;
use Illuminate\Support\ServiceProvider;

class ProblemServiceProvider extends ServiceProvider
{
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
        //
        $this->app->singleton('problem',function(){
            return new ProblemService();
        });

        //使用bind绑定实例到接口以便依赖注入
        $this->app->bind('App\Contracts\ProblemContract',function(){
            return new ProblemService();
        });
    }
}
