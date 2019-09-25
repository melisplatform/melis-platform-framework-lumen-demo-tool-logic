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
        // get all data in demo table
        $data = MelisDemoAlbumTableLumen::query()->orderBy('alb_id','desc')->get();
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

    /**
     * @return \Illuminate\View\View
     */
    public function renderMelisPugin()
    {
        // getting the view in this module
        return view("$this->viewNamespace::melis-plugin", ['data' => MelisDemoAlbumTableLumen::all()]);

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

}
