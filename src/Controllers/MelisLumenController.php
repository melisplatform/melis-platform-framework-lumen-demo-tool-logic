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

        // view variables
        $viewVariables = [
            'data' => $data,
            'coreLang' => $coreLangData,
        ];

        // getting the view in this module
        return view('MelisPlatformFrameworkLumenDemoToolLogic::melis-lumen', $viewVariables);
    }

}
