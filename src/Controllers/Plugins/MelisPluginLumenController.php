<?php
namespace MelisPlatformFrameworkLumenDemoToolLogic\Controllers\Plugins;

use MelisPlatformFrameworkLumenDemoToolLogic\Model\MelisDemoAlbumTableLumen;

class MelisPluginLumenController
{
    /**
     *  default namespace that was set in the serviceprovider classs
     * @var string
     */
    private $viewNamespace = "MelisPlatformFrameworkLumenDemoToolLogic";
    /**
     * render the plugin
     *
     * @return \Illuminate\View\View
     */
    public function renderMelisPugin()
    {
        // getting the view in this module
        return view("$this->viewNamespace::plugins/melis-plugin", ['data' => MelisDemoAlbumTableLumen::all()]);

    }
}