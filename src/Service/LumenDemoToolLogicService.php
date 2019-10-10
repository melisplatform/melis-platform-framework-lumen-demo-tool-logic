<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Service;

use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;

class LumenDemoToolLogicService
{
    /**
     * @param $start
     * @param $limit
     * @param $searchableCols
     * @param $search
     * @param $orderBy
     * @param $orderDir
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getAlbumData($start,$limit,$searchableCols,$search,$orderBy,$orderDir)
    {
        $data = MelisDemoAlbumTableLumen::query()
            ->where(function($query) use ($searchableCols,$search){
                if (! empty($searchableCols)) {
                    $where = "";
                    foreach ($searchableCols as $idx => $col) {
                        if ($idx == 0){
                            $query->where($col,"like","%$search%");
                        } else {
                            $query->orWhere($col,"like","%$search%");
                        }
                    }
                }
            })
            ->skip($start)
            ->limit($limit)
            ->orderBy($orderBy,$orderDir)
            ->get();

        return [
            'data' => $data,
            'dataCount' => $data->count()
        ];

    }
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
}