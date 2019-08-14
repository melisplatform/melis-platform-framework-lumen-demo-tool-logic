<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Model;

use Illuminate\Database\Eloquent\Model;

class MelisDemoAlbumTableLumen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var $table
     */
    protected $table = 'melis_demo_album_table_lumen';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'alb_id';
}