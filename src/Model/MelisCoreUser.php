<?php

namespace MelisPlatformFrameworkLumenDemoToolLogic\Model;


use Illuminate\Database\Eloquent\Model;

class MelisCoreUser extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'melis';
    /*
     * sample table from melis database
     */
    protected $table = 'melis_core_user';
}