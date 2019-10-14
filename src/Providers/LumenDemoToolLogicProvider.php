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
        # create translations based on locale
        $this->createTranslations();
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
        $config = $this->translateTableColumns($config);
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

    /**
     * create translations based on locale
     * @throws \Exception
     */
    private function createTranslations()
    {
        # zend translation
        $translator = MelisServiceProvider::getService('translator');
        # get melis back office locale
        $locale = MelisServiceProvider::getMelisLocale();
        # check locale
        if (!empty($locale)) {
            # translation type
            # ex. en_EN.table.php | ge_GE.table.php
            $translationType = [
                'table'
            ];
            # get all translation files and then add it in the translator
            foreach ($translationType as $type) {
                # if translation is not found, use melis default translations
                $defaultLocale = (file_exists(__DIR__ . "/../../language/$locale.$type.php")) ? $locale : "en_EN";
                # set translation path
                $transPath = __DIR__ . "/../../language/$defaultLocale.$type.php";
                # create translations
                if (file_exists($transPath)) {
                    $translator->addTranslationFile('phparray', $transPath);
                }
            }
        }
        # update the zendTranslator with the new added translations
        $this->app->singleton('ZendTranslator',function() use($translator){
            return $translator;
        });
    }
    

}