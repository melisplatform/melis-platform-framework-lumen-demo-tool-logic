<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Providers;

use Illuminate\Support\ServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Serivce\MelisPlatformFrameworkLumenDemoToolLogicService;

class LumenDemoToolLogicProvider extends ServiceProvider
{
    public function boot()
    {
        // load routes in the lumen application
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        // load views in the lumen application
        $this->loadViewsFrom(__DIR__ . '/../../views','MelisPlatformFrameworkLumenDemoToolLogic');
    }
}