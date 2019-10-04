<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Service;

use MelisCore\Service\MelisCoreFlashMessengerService;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;

class MelisPlatformFrameworkLumenDemoToolLogicService
{
    
    /**
     * @param $data
     * @param null $id
     * @return bool|int
     */
    public function saveAlbumData($data,$id = null)
    {
        $success = false;
        if (empty($id)){
            // insert new row
            $id = MelisDemoAlbumTableLumen::query()->insertGetId($data);
            $success = true;

        } else {
            $success = MelisDemoAlbumTableLumen::query()->where('alb_id',$id)->update($data);
        }

        return [
            'success' => $success,
            'id'      => $id
        ];
    }

    /**
     * @param $id
     * @return bool|\Illuminate\Database\Eloquent\Builder
     */
    public function deleteAlbum($id)
    {
        $success = false;

        if ($id) {
            // delete album
            $success = MelisDemoAlbumTableLumen::query()->where('alb_id',$id)->delete();
        }

        return [
            'success' => $success,
            'id'      => $id
        ];
    }

    /**
     * @param $title
     * @param $message
     * @param string $icon
     */
    public function addToFlashMessenger($title,$message,$icon = MelisCoreFlashMessengerService::INFO)
    {
        /** @var MelisCoreFlashMessengerService $flashMessenger */
        $flashMessenger = app('ZendServiceManager')->get('MelisCoreFlashMessenger');
        $flashMessenger->addToFlashMessenger($title, $message, $icon);
    }

    /**
     * @param $title
     * @param $message
     * @param $success
     * @param $typeCode
     * @param $itemId
     */
    public function saveLogs($title,$message,$success,$typeCode,$itemId)
    {
        $logSrv = app('ZendServiceManager')->get('MelisCoreLogService');
        $logSrv->saveLog($title, $message, $success, $typeCode, $itemId);
    }
}