<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use MelisPlatformFrameworkLumen\MelisServices;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisCoreUser;

class MelisLumenController extends BaseController
{

    public function renderMelisLumen()
    {
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::all();
        /*
         * get melis cms news service from melis-platform
         */
        $zendServiceManager = app('ZendServiceManager');
        // get melis cms news service
        $newsSvc = $zendServiceManager->get('MelisCmsNewsService');
        // get news list in melis platform
        $newsData = $newsSvc->getNewsList();
        // example of using the melis connection through a Model
        $melisCoreUsers = MelisCoreUser::all();
        // example of using melis connection through DB Illuminate\Support\Facades\ class
        $melisCoreUserConnectionLogs = DB::connection('melis')->table('melis_core_user_connection_date')->get();

        // view variables
        $viewVariables = [
            'data' => $data,
            'newsData' => $newsData,
            'coreUsersData' => $melisCoreUsers,
            'coreUserConnectionLogs' => $melisCoreUserConnectionLogs
        ];

        // getting the view in this module
        return view('MelisPlatformFrameworkLumenDemoToolLogic::melis-lumen', $viewVariables);
    }

}
