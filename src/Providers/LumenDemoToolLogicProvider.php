<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Serivce\MelisPlatformFrameworkLumenDemoToolLogicService;
use Zend\Session\Container;

class LumenDemoToolLogicProvider extends ServiceProvider
{
    public function boot()
    {
        # load routes in the lumen application
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        # load views in the lumen application
        $this->loadViewsFrom(__DIR__ . '/../../views','MelisPlatformFrameworkLumenDemoToolLogic');
        # include table config
        $this->addTableConfig();
    }

    /**
     * for easy configuration of dynamic table
     */
    private function addTableConfig()
    {
        # add config
        $config = include __DIR__ . "/../../config/table.config.php";
        # translate colun translations
        $this->translateTableColumns($config);
    }

    /**
     *
     *  translate columns that was set in the table config
     *
     * @param $config
     * @throws \Exception
     */
    private function translateTableColumns($config)
    {
        # table columns
        foreach ($config['table']['columns'] as $field => $val) {
            $config['table']['columns'][$field]['text'] = app('ZendTranslator')->translate($val['text']);
        }
        # set config
        Config::set('album_table_config', $config);
    }

    

}