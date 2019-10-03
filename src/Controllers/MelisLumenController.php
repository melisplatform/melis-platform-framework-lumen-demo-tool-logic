<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
use MelisCore\Service\MelisCoreFlashMessengerService;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;
use mysql_xdevapi\Exception;
use MelisPlatformFrameworkLumenDemoToolLogic\Service\MelisPlatformFrameworkLumenDemoToolLogicService as LumenDemoToolLogicService;

class MelisLumenController extends BaseController
{
    private $viewNamespace = "MelisPlatformFrameworkLumenDemoToolLogic";
    /**
     * @return \Illuminate\View\View
     */
    public function renderMelisLumen()
    {
        // view variables
        $viewVariables = [
            'data' =>  MelisDemoAlbumTableLumen::query()->orderBy('alb_id','desc')->get()
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
        $albumId = app('request')->request->get('albumId') ?? null;
        $data = [];
        if ($albumId){
            $data = MelisDemoAlbumTableLumen::query()->find($albumId);
        }

        return view("$this->viewNamespace::lumen-tool/tool-modal-content",['data' => $data]);
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
        $validator = Validator::make($requestParams,[
            'alb_name' => 'required|regex:/^[a-zA-Z0-9\s]*$/',
            'alb_song_num' => 'integer'
        ],[
            'alb_song_num.integer' => app('ZendTranslator')->translate('tr_melis_lumen_notification_songs_not_int'),
            'alb_name.required' => app('ZendTranslator')->translate('tr_melis_lumen_notification_empty_name'),
            'alb_name.regex' => app('ZendTranslator')->translate('tr_melis_lumen_notification_empty_name_regex'),
        ]);
        // validate inputed data
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            // add translation to keys
            $keyTranslations = [
                'alb_name' => [
                    'label' => app('ZendTranslator')->translate('tr_melis_lumen_table1_heading_name')
                ],
                'alb_song_num' => [
                    'label' => app('ZendTranslator')->translate('tr_melis_lumen_table1_heading_songs')
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
        $lumenDemoToolLogicSvc = new LumenDemoToolLogicService();
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
                unset($requestParams['alb_id']);
                // update album
                $lumenDemoToolLogicSvc->saveAlbumData($requestParams,$id);
                // set message
                $message = "tr_melis_lumen_notification_message_upate_ok";
                // set log type code
                $logTypeCode = "LUMEN_DEMO_TOOL_UPDATE";
            } else {
                // include date
                $requestParams['alb_date'] = date('Y-m-d h:i:s');
                // save album data
                $id = $lumenDemoToolLogicSvc->saveAlbumData($requestParams);
                // set message
                $message = "tr_melis_lumen_notification_message_save_ok";
            }
        }

        // add to melis flash messenger
        $lumenDemoToolLogicSvc->addToFlashMessenger($title, $message,$icon);
        // save into melis logs
        $lumenDemoToolLogicSvc->saveLogs($title, $message, $success, $logTypeCode, $id);

        // return required data
        return [
            'errors' => $errors,
            'success' => $success,
            'textMessage' => app('ZendTranslator')->translate($message),
            'textTitle' => app('ZendTranslator')->translate($title)
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
            throw new Exception('No album id');
        }

        // Lumen demo tool logic service
        $lumenDemoToolLogicSvc = new LumenDemoToolLogicService();

        if ($lumenDemoToolLogicSvc->deleteAlbum($albumId)) {
            $success = true;
            $icon = MelisCoreFlashMessengerService::INFO;
            $message = "Successfully deleted";
        }

        // add to melis flash messenger
        $lumenDemoToolLogicSvc->addToFlashMessenger($title, $message,$icon);
        // save into melis logs
        $lumenDemoToolLogicSvc->saveLogs($title, $message, $success, $logTypeCode, $albumId);

        return [
            'success' => $success,
            'error'   => $errors,
            'textMessage' => app('ZendTranslator')->translate($message),
            'textTitle' => app('ZendTranslator')->translate($title)
        ];
    }
}
