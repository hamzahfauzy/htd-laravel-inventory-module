<?php

namespace App\Modules\Inventory\Providers;

use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Databases/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        // $this->loadViewsFrom(__DIR__.'/../Views', 'base');
    }
}