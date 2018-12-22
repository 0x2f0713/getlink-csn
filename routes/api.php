<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('csn/', 'CSN@getDownloadLinks');
Route::get('csn-search', 'CSN@search');
Route::get('csn-album', 'CSN@getAlbum');