<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use MelisPlatformFrameworkLumen\MelisServices;

class MelisLumenController extends BaseController
{

    protected $melisServices;

    public function __construct()
    {
        $this->melisServices = new MelisServices();
    }

    public function renderMelisLumen()
    {
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::all();
        // lumen request
        $request = Request::capture();
//        $pageId  = $request->request->get('pageId');
//        $pageData = $this->melisServices->getPageData($pageId);
        $newsSvc = $this->melisServices->getService('MelisCmsNewsService');
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
