<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Serivce\MelisPlatformFrameworkLumenDemoToolLogicService;
use MelisPlatformFrameworkLumenDemoToolLogic\Service\LumenDemoToolLogicService;
use Laminas\Session\Container;

class LumenDemoToolLogicProvider extends ServiceProvider
{
    public function boot()
    {
        // load routes in the lumen application
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        // load views in the lumen application
        $this->loadViewsFrom(__DIR__ . '/../../views','MelisPlatformFrameworkLumenDemoToolLogic');
        // load transations
        $this->loadTranslationsFrom(__DIR__ . '/../../language', 'lumenDemo');
        // include table config
        $this->addTableConfig();
        // include form config
        $this->addFormConfig();
    }
    public function register()
    {
        // lumen demo logic service
        $this->app->singleton('LumenToolService' , function(){
            return new LumenDemoToolLogicService();
        });
    }

    /**
     * for easy configuration of dynamic table
     */
    private function addTableConfig()
    {
        // add config
        $config = include __DIR__ . "/../../config/table.config.php";
        // translate colun translations
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
        // table columns
        foreach ($config['table']['columns'] as $field => $val) {
            $config['table']['columns'][$field]['text'] = app('LaminasTranslator')->translate($val['text']);
        }
        // set config
        Config::set('album_table_config', $config);
    }
    private function addFormConfig()
    {
        // add config
        $config = include __DIR__ . "/../../config/form.config.php";
        // set config
        Config::set('album_form', $config);
    }

    

}
