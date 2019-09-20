<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use MelisPlatformFrameworkLumen\MelisServices;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisCoreUser;

class MelisLumenController extends BaseController
{
    private $viewNamespace = "MelisPlatformFrameworkLumenDemoToolLogic";
    /**
     * @return \Illuminate\View\View
     */
    public function renderMelisLumen()
    {
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::all();
        // get zend service manager
        $zendServiceManager = app('ZendServiceManager');
        // get melis cms news service from melis-platform
        /** @var \MelisCore\Model\Tables\MelisLangTable $melisCoreLang */
        $melisCoreLang = $zendServiceManager->get('MelisCoreTableLang');
        // get news list in melis platform
        $coreLangData = $melisCoreLang->fetchAll()->toArray();
        $textHeading1 = $zendServiceManager->get('translator')->translate('tr_melis_lumen_demo_tool_sample_1_heading');
        $textHeading2 = $zendServiceManager->get('translator')->translate('tr_melis_lumen_demo_tool_sample_2_heading');

        // view variables
        $viewVariables = [
            'data' => $data,
            'coreLang' => $coreLangData
        ];

        // getting the view in this module
        return view("$this->viewNamespace::melis-lumen", $viewVariables);
    }

    public function renderMelisPugin()
    {
        // getting the view in this module
        return view("$this->viewNamespace::melis-plugin", ['data' => MelisDemoAlbumTableLumen::all()]);

    }
    public function renderAddLumenAlbum()
    {
        return view("$this->viewNamespace::render-add-lumen");
    }

}
