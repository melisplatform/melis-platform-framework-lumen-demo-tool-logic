<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Serivce\MelisPlatformFrameworkLumenDemoToolLogicService;

class LumenDemoToolLogicProvider extends ServiceProvider
{
    public function boot()
    {
        // load routes in the lumen application
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        // load views in the lumen application
        $this->loadViewsFrom(__DIR__ . '/../../views','MelisPlatformFrameworkLumenDemoToolLogic');
        // include table config
        $this->addTableConfig();
    }

    private function addTableConfig()
    {
        // add config
        $config = include __DIR__ . "/../../config/table.config.php";
        $config = $this->translateColumns($config);
    }
    private function translateColumns($config)
    {
        $zendTranslator = MelisServiceProvider::getService('translator');
        // table columns
        foreach ($config['table']['columns'] as $field => $val) {
            $config['table']['columns'][$field]['text'] = $zendTranslator->translate($val['text']);
        }

        Config::set('album_table_config', $config);
    }
    

}