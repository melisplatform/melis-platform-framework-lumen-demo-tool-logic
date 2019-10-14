<?php

use  \MelisPlatformFrameworkLumenDemoToolLogic\Controllers\MelisLumenController;
use \MelisPlatformFrameworkLumenDemoToolLogic\Controllers\Plugins\MelisPluginLumenController;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/melis/lumen-list',  MelisLumenController::class ."@renderMelisLumen");
Route::get('/melis/lumen-plugin',  MelisPluginLumenController::class ."@renderMelisPugin");

Route::get('/melis/lumen-get-album-form', [
    'uses' => MelisLumenController::class ."@toolModalContent",
]);
# save album
Route::post('/melis/save-lumen-album' , MelisLumenController::class . "@saveAlbum");
# edit album
Route::get('/melis/edit-lumen-album' , MelisLumenController::class . "@editLumenAlbum");
# delete an album
Route::post('/melis/delete-lumen-album' , MelisLumenController::class . "@deleteAlbum");
# get data for datatable
Route::post('/melis/lumen-get-table-data', MelisLumenController::class . "@getAlbumData");




