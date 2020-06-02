<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Inicio','Controller@Inicio');

Route::get('/Sobre_Nosotros','Controller@Sobre_Nosotros');

Route::get('/Contacto','Controller@Contacto');

Route::get('/Menu','Controller@Menu');

Route::get('/order','Controller@order');

Route::get('/Admin','Controller@Admin');

Route::get('/admin_add','Controller@admin_add');

Route::get('/admin_update','Controller@admin_update');

Route::get('/admin_remove','Controller@admin_remove');

Route::get('/logout','Controller@logout');

Route::any('/info','Controller@info');

Route::post('/register','Controller@register');

Route::post('/login','Controller@login');

Route::post('/addburger','Controller@addburger');

Route::post('/updateburger','Controller@updateburger');

Route::post('/deleteburger','Controller@deleteburger');

Route::post('/burger_info','Controller@burger_info');

Route::post('/store_review','Controller@store_review');

Route::post('/place_order','Controller@place_order');

Route::Post('/Inicio#modal2','Controller@modal');