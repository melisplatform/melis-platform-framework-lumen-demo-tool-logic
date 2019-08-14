<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;

class MelisLumenController extends BaseController
{
    public function renderMelisLumen()
    {
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::all();
        $viewVariables = [
            'data' => $data
        ];
        // getting the view in this module
        return view('MelisPlatformFrameworkLumenDemoToolLogic::melis-lumen', $viewVariables);
    }

}
