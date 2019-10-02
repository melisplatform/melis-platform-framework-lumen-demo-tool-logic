<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Model;

use Illuminate\Database\Eloquent\Model;

class MelisDemoAlbumTableLumen extends Model
{
    /**
     * Connection
     */
    protected $connection = "melis";
    /**
     * The table associated with the model.
     *
     * @var $table
     */
    protected $table = 'melis_demo_album';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'alb_id';
}