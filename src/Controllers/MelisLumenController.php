<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;
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
        $message = "Unable to saved";
        // default title
        $title = "Lumen demo tool album";
        // get all request parameters
        $requestParams = app('request')->request->all();
        // log type for melis logging system
        $logTypeCode = "LUMEN_DEMO_TOOL_SAVE";
        // id
        $id = null;
        // validate inputed data
        $validator = Validator::make($requestParams,[
            'alb_name' => 'required|integer',
            'alb_song_num' => 'integer'
        ],[
            'alb_song_num.integer' => 'Hoy ! Dapat integer',
            'alb_name.required' => 'Hoy ! Requuired oy',
        ],[
            'alb_name' => 'Name'
        ]);
        // get error messages
        if ($validator->fails()) {
            $errors = $validator->errors()->getMessages();
        }
        // Lumen demo tool logic service
        $lumenDemoToolLogicSvc = new LumenDemoToolLogicService();
        // check for errors
        if (empty($errors)) {
            // set to true
            $success = true;
            // include date
            $requestParams['alb_date'] = date('Y-m-d h:i:s');
            // check for id
            if (isset($requestParams['alb_id']) && ! empty($requestParams['alb_id'])) {
                // set id
                $id = $requestParams['alb_id'];
                unset($requestParams['alb_id']);
                // update album
                $lumenDemoToolLogicSvc->saveAlbumData($requestParams,$id);
                // set message
                $message = "Successfully updated";
                // set log type code
                $logTypeCode = "LUMEN_DEMO_TOOL_UPDATE";
            } else {
                // save album data
                $id = $lumenDemoToolLogicSvc->saveAlbumData($requestParams);
                // set message
                $message = "Successfully saved";
            }
        }

        // add to melis flash messenger
        $lumenDemoToolLogicSvc->addToFlashMessenger($title, $message);
        // save into melis logs
        $lumenDemoToolLogicSvc->saveLogs($title, $message, $success, $logTypeCode, $id);

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
        $title = "Lumen demo tool album";
        // get all request parameters
        $requestParams = app('request')->request->all();
        // log type for melis logging system
        $logTypeCode = "LUMEN_DEMO_TOOL_DELETE";
        // id
        $albumId = app('request')->request->get('albumId');

        if (empty($albumId)) {
            throw new Exception('No album id');
        }

        // Lumen demo tool logic service
        $lumenDemoToolLogicSvc = new LumenDemoToolLogicService();

        if ($lumenDemoToolLogicSvc->deleteAlbum($albumId)) {
            $success = true;
            $message = "Successfully deleted";
        }

        return [
            'success' => $success,
            'error'   => $error,
            'textMessage' => $message,
            'textTitle' => $title
        ];
    }
}
