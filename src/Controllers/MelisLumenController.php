<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
        $request = app('request');
        $start   = $request->get('start') ?? 0;
        $limit   = $request->get('limit') ?? 5;
        $search   = $request->get('search') ?? null;
        $orderBy   = $request->get('order-by') ?? 'alb_id';
        $orderDir   = $request->get('order-direction') ?? 'desc';
        // get all data in demo table
        $data = $this->getLumenAlbumTableData();

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
            'coreLang' => $coreLangData,
            'tableConfig' => [
                'start' => $start,
                'limit' => $limit,
                'search' => $search,
                'orderBy' => $orderBy,
                'orderDir' => $orderDir
            ]
        ];

        // getting the view in this module
        return view("$this->viewNamespace::lumen-tool/tool-main-content", $viewVariables);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function renderMelisPugin()
    {
        // getting the view in this module
        return view("$this->viewNamespace::plugins/melis-plugin", ['data' => MelisDemoAlbumTableLumen::all()]);

    }

    /**
     * @return \Illuminate\View\View
     */
    public function toolModalContent()
    {
        return view("$this->viewNamespace::lumen-tool/tool-modal-content");
    }

    /**
     * @return array
     */
    public function saveLumenAlbum()
    {
        $errors = [];
        $success = false;
        $message = "Failed";
        $title = "Lumen";
        $requestParams = app('request')->request->all();

        // validate inputed data
        $validor = Validator::make($requestParams,[
            'alb_name' => 'required'
        ]);
        // check for errors
        if ($validor->fails()) {
            $errors = $validor->errors()->getMessages();
        }

        if (empty($errors)) {
            $success = true;
            // include date
            $requestParams['alb_date'] = date('Y-m-d h:i:s');
            // save
            if(MelisDemoAlbumTableLumen::query()->insert($requestParams)) {
                $message = "Successfully saved";
            }
        }

        return [
            'errors' => $errors,
            'success' => $success,
            'textMessage' => $message,
            'textTitle' => $title
        ];
    }

    /**
     * @param int $start
     * @param int $limit
     * @param string $search
     * @param string $oderBy
     * @param string $orderDirection
     * @return array
     */
    public function getLumenAlbumTableData($start = 0,$limit = 5,$search = "",$orderBy = 'alb_id',$oderDirection = 'desc')
    {
        $query = MelisDemoAlbumTableLumen::query();

        if (! empty($start)) {
            $query->skip($start);
        }
        if (! empty($limit)) {
            $query->take($limit);
        }
        if (! empty($orderBy)) {
            $query->orderBy($orderBy, $oderDirection ?? 'desc');
        }
        if(! empty($search)) {
            $query->where('alb_name','like','%' . $search . '%');
        }


        return $query->get();
    }

}
