<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Service;

use Illuminate\Support\Facades\Config;
use MelisPlatformFrameworkLumen\MelisServiceProvider;
use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;

class LumenDemoToolLogicService
{
    /**
     * Return data from melis_demo_album table
     *
     * @param $start
     * @param $limit
     * @param $searchableCols
     * @param $search
     * @param $orderBy
     * @param $orderDir
     * @return array
     * @throws \Exception
     */
    public function getAlbumData($start,$limit,$searchableCols,$search,$orderBy,$orderDir)
    {
        $data = [];
        try {
            $data = MelisDemoAlbumTableLumen::query()
                ->where(function($query) use ($searchableCols,$search){
                    if (! empty($searchableCols) && !empty($search)) {
                        foreach ($searchableCols as $idx => $col) {
                            $query->orWhere($col,"like","%$search%");
                        }
                    }
                })
                ->skip($start)
                ->limit($limit)
                ->orderBy($orderBy,$orderDir)
                ->get();


        }catch (\Exception $err) {
            // return error
            throw new \Exception($err->getMessage());
        }
        // count all with no filters
        $tmpDataCount = MelisDemoAlbumTableLumen::all()->count();
        // count data with filters
        if (! empty($searchableCols) && !empty($search)) {
            $tmpDataCount = $data->count();
        }
        return [
            'data' => $data,
            'dataCount' => $tmpDataCount
        ];

    }

    /**
     *  save album data
     *
     * @param $data
     * @param null $id
     * @return array
     * @throws \Exception
     */
    public function saveAlbumData($data,$id = null)
    {
        $success = false;
        try {
            if (empty($id)){
                // insert new row
                $id = MelisDemoAlbumTableLumen::query()->insertGetId($data);
                $success = true;

            } else {
                $success = MelisDemoAlbumTableLumen::query()->where('alb_id',$id)->update($data);
            }
        } catch(\Exception $err) {
            throw new \Exception($err->getMessage());
        }

        return [
            'success' => $success,
            'id'      => $id
        ];
    }

    /**
     *
     * Delete an album
     *
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function deleteAlbum($id)
    {
        $success = false;
        try {
            if ($id) {
                // delete album
                $success = MelisDemoAlbumTableLumen::query()->where('alb_id',$id)->delete();
            }
        } catch(\Exception $err) {
            // throw error
            throw new \Exception($err->getMessage());
        }

        return [
            'success' => $success,
            'id'      => $id
        ];
    }

    /**
     * @param $albumName
     * @return array
     */
    public function getAlbumByName($albumName)
    {
       return MelisDemoAlbumTableLumen::query()->where('alb_name',$albumName)->first();
    }

    public function getAlbumById($id)
    {
        return MelisDemoAlbumTableLumen::query()->where('alb_id',$id)->first();
    }
    public function getAlbumForm($id = null)
    {
        return $this->constructForm(Config::get('album_form'), $id);
    }
    public function constructForm($formConfig,$id = null)
    {
        $formInputsType = [
            'text',
            'radio',
            'password',
            'hidden',
            'checkbox',
            'file',
        ];
        $htmlForm = "";
        if(!empty($formConfig)) {
            if ($this->checkArraykey('form',$formConfig)) {
                // check for form attributes
                $formAttributes = "";
                if ($this->checkArraykey('attributes',$formConfig['form'])) {
                    foreach ($formConfig['form']['attributes'] as $idx => $val) {
                        $formAttributes .= $idx . "='" . $val . "' ";
                    }
                }
                // put attributes
                $htmlForm.= "<form " . $formAttributes .">";
                $formElements = "";
                // check for form elements
                if ($this->checkArraykey('elements',$formConfig['form'])) {
                    foreach ($formConfig['form']['elements'] as $idx => $elements) {
                        // check element type
                        if ($this->checkArraykey('type',$elements)) {
                            if (in_array($elements['type'] ?? null, $formInputsType)) {
                                $formElements .= "<label>" . ($elements['label'] ?? null) . "<input type='" .  $elements['type'] . "' /> </label>";
                            }
                        }
                    }
                }
                $htmlForm .= $formElements . "</form>";

                echo $htmlForm;
            }
        }
    }

    private function checkArraykey($key,$array)
    {
        if (isset($array[$key]) && $array[$key]) {
            return true;
        }

        return false;
    }


}