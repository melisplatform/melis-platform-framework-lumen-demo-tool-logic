<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use MelisPlatformFrameworkLumen\MelisServices;

class MelisLumenController extends BaseController
{

    public function renderMelisLumen()
    {
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::all();
        $melisServices = new MelisServices();
        $newsSvc = $melisServices->getService('MelisCmsNewsService');
        $newsData = $newsSvc->getNewsList();

        // view variables
        $viewVariables = [
            'data' => $data,
            'newsData' => $newsData
        ];

        // getting the view in this module
        return view('MelisPlatformFrameworkLumenDemoToolLogic::melis-lumen', $viewVariables);
    }

}
