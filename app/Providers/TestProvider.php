<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 测试
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 返回测试方法实例
        $this->app->bind('\Test\TestClass', function($app) {
            
            return new \Test\TestClass($app->make('\Test\SubTestClass'));
        });
    }
}
