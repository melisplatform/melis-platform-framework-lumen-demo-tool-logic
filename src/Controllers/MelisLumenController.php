<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Composer\Package\Package;
use Illuminate\Http\Request;use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\Controller as BaseController;
use MelisCore\Service\MelisCoreFlashMessengerService;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use MelisPlatformFrameworkLumenDemoToolLogic\Service\LumenDemoToolLogicService as LogicService;
use MelisPlatformFrameworkLumen\Service\MelisPlatformToolLumenService;

class MelisLumenController extends BaseController
{
    private $viewNamespace = "MelisPlatformFrameworkLumenDemoToolLogic";
    protected $transNamespace = "lumenDemo";
    /** @var MelisPlatformToolLumenService */
    protected $melisPlatformToolService;
    /**
     * @var
     */
    protected $lumenToolService;
    public function __construct(LogicService $lumenService, MelisPlatformToolLumenService $melisLumen)
    {
        $this->melisPlatformToolService = $melisLumen;
        $this->lumenToolService = $lumenService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function renderMelisLumen()
    {
        // get zend service manager
        $zendServiceManager = app('ZendServiceManager');

        // get melis cms news service from melis-platform
        /** @var \MelisCore\Model\Tables\MelisLangTable $melisCoreLang */
        $melisCoreLang = $zendServiceManager->get('MelisCoreTableLang');
        // view variables
        $viewVariables = [
            'dataTable' => "",
            'coreLang'  => $melisCoreLang->fetchAll()->toArray(),
        ];


        // getting the view in this module
        return view("$this->viewNamespace::lumen-tool/tool-main-content", $viewVariables);
    }
    /**
     * @return \Illuminate\View\View
     */
    public function toolModalContent($id = null)
    {
        $albumId = app('request')->request->get('albumId') ?? null;
        $data = [];
        if ($albumId) {
            $data = $this->lumenToolService->getAlbumById($albumId)->toArray();
        }

        return view("$this->viewNamespace::lumen-tool/tool-modal-content",[
            'form' => $this->melisPlatformToolService->createDynamicForm(Config::get('album_form'),$data),
            'id' => $albumId
        ]);
    }

    /**
     *
     * retrieve the data
     *
     * @return array
     */
    public function getAlbumData()
    {
        $request = app('request');
        $success = 0;
        $colId = array();
        $dataCount = 0;
        $draw = 0;
        $dataFiltered = 0;
        $tableData = array();

        if($request->getMethod() == Request::METHOD_POST) {

           $lumenAlbumSrvc = $this->lumenToolService;
           $params = $request->request->all();
           /*
            * standard datatable configuration
            */

           $sortOrder = $params['order'][0]['dir'];
           $selCol    = $params['order'];
           $colId     = array_keys(config('album_table_config')['table']['columns']);
           $selCol    = $colId[$selCol[0]['column']];
           $draw      = $params['draw'];
           // pagination start
           $start     = $params['start'];
           // drop down limit
           $length    = $params['length'];
           // search value from the table
           $search    = $params['search']['value'];
           // get all searchable columns from the config
           $searchableCols = config('album_table_config')['table']['searchables'] ?? [];
           // get data from the service
           $data = $lumenAlbumSrvc->getAlbumData($start,$length,$searchableCols,$search,$selCol,$sortOrder);
           // get total count of the data in the db
           $dataCount = $data['dataCount'];
           $albumData = $data['data'];
           // organized data
           $c = 0;
           foreach($albumData as $data){
               $tableData[$c]['DT_RowId'] = $data->alb_id;
               $tableData[$c]['alb_id'] = $data->alb_id;
               $tableData[$c]['alb_name'] = $data->alb_name;
               $tableData[$c]['alb_date'] = $data->alb_date;
               $tableData[$c]['alb_song_num'] = $data->alb_song_num;
               $c++;
           }
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $dataCount,
            'recordsFiltered' => $dataCount,
            'data' => $tableData
        ];

    }
    /**
     * Create or update an album
     *
     * @return array
     */
    public function saveAlbum()
    {
        // errors
        $errors = [];
        // success status
        $success = false;
        // default message
        $message = "tr_melis_lumen_notification_message_save_ko";
        // default title
        $title = "tr_melis_lumen_notification_title";
        // get all request parameters
        $requestParams = app('request')->request->all();
        // log type for melis logging system
        $logTypeCode = "LUMEN_DEMO_TOOL_SAVE";
        // flash messages icon
        $icon = MelisCoreFlashMessengerService::WARNING;
        // id
        $id = null;
        // make a validator for the request parameters
        // zend translator
        /** @var \Zend\Mvc\I18n\Translator $zendTranslator */
        $zendTranslator = app('ZendTranslator');
        $validator = Validator::make($requestParams,[
            'alb_name' => 'required',
            'alb_song_num' => 'required|integer'
        ],[
            'alb_song_num.integer' => __($this->transNamespace . '::translations.tr_melis_lumen_notification_songs_not_int'),
            'alb_song_num.required' => __($this->transNamespace . '::translations.tr_melis_lumen_notification_empty'),
            'alb_name.required' => __($this->transNamespace .'::translations.tr_melis_lumen_notification_empty'),
//            'alb_name.regex' => __($this->transNamespace . '::translations.tr_melis_lumen_notification_empty_name_regex'),
        ]);
        // validate inputed data
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            // add translation to keys
            $keyTranslations = [
                'alb_name' => [
                    'label' => __($this->transNamespace . '::translations.tr_melis_lumen_table1_heading_name')
                ],
                'alb_song_num' => [
                    'label' => __($this->transNamespace . '::translations.tr_melis_lumen_table1_heading_songs')
                ]
            ];
            // asigning label
            foreach ($errors as $errorKey => $errorVal) {
                if (array_key_exists($errorKey,$keyTranslations)) {
                    $errors[$errorKey]['label'] = $keyTranslations[$errorKey]['label'];
                }
            }
        }
        // Lumen demo tool logic service
        $lumenDemoToolLogicSvc = $this->lumenToolService;
        // Melis platform tool lumen service
        //$lumenService          = new MelisPlatformToolLumenService();
        // check for album name in the db
        $tmpData = $lumenDemoToolLogicSvc->getAlbumByName($requestParams['alb_name']);
        if(!empty($tmpData) && $tmpData->alb_id != ($requestParams['alb_id'] ?? null)) {
            if (!isset($errors['alb_name'])) {
                // set errors
                $errors['alb_name'] = [
                    'alreadyExists' => __($this->transNamespace . '::translations.tr_melis_lumen_album_name_already_used'),
                    'label'         => __($this->transNamespace . '::translations.tr_melis_lumen_table1_heading_name')
                ];
            }
        }
        // check for errors
        if (empty($errors)) {

            // set to true
            $success = true;
            // set info icon for flash messeages
            $icon = MelisCoreFlashMessengerService::INFO;
            // check for id
            if (isset($requestParams['alb_id']) && ! empty($requestParams['alb_id'])) {
                // set id
                $id = $requestParams['alb_id'];
                // remove id from the parameters
                unset($requestParams['alb_id']);
                // set log type code
                $logTypeCode = "LUMEN_DEMO_TOOL_UPDATE";
                // update album
                $lumenDemoToolLogicSvc->saveAlbumData($requestParams,$id);
                // set message
                $message = "tr_melis_lumen_notification_message_upate_ok";
            } else {
                // include date
                $requestParams['alb_date'] = date('Y-m-d h:i:s');
                // save album data
                $id = $lumenDemoToolLogicSvc->saveAlbumData($requestParams)['id'];
                // set message
                $message = "tr_melis_lumen_notification_message_save_ok";
            }
        }

        // add to melis flash messenger
        $this->melisPlatformToolService->addToFlashMessenger($title, $message,$icon);
        // save into melis logs
        $this->melisPlatformToolService->saveLogs($title, $message, $success, $logTypeCode, $id);

        // return required data
        return [
            'errors' => $errors,
            'success' => $success,
            'textMessage' => $message,
            'textTitle' => $title
        ];
    }

    /**
     * Delete an album
     *
     * @return array
     */
    public function deleteAlbum()
    {
        // errors
        $errors = [];
        // success status
        $success = false;
        // default message
        $message = "Unable to saved";
        // default title
        $title = "tr_melis_lumen_notification_title";
        // get all request parameters
        $requestParams = app('request')->request->all();
        // log type for melis logging system
        $logTypeCode = "LUMEN_DEMO_TOOL_DELETE";
        // flash messages icon
        $icon = MelisCoreFlashMessengerService::WARNING;
        // id
        $albumId = app('request')->request->get('albumId');

        if (empty($albumId)) {
            throw new \Exception('No album id');
        }

        // Lumen demo tool logic service
        $lumenDemoToolLogicSvc = $this->lumenToolService;

        if ($lumenDemoToolLogicSvc->deleteAlbum($albumId)) {
            $success = true;
            $icon = MelisCoreFlashMessengerService::INFO;
            $message = "tr_melis_lumen_notification_message_delete_ok";
        }

        // add to melis flash messenger
        $this->melisPlatformToolService->addToFlashMessenger($title, $message,$icon);
        // save into melis logs
        $this->melisPlatformToolService->saveLogs($title, $message, $success, $logTypeCode, $albumId);

        return [
            'success' => $success,
            'error'   => $errors,
            'textMessage' => $message,
            'textTitle' => $title
        ];
    }

    /**
     * retrieve album info by id
     *
     * @param $id
     * @return array
     */
    public function getAlbumInfo($id)
    {
        return $this->lumenToolService->getAlbumById($id)->toArray();
    }



}
