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

Route::get('/usuarios', 'UsuariosController@usuarios');
Route::get('/usuarios/agregar', 'UsuariosController@verAgregar');

Route::get('/', function(){
    
    if (request()->has('no')) {
        $error = "Credenciales incorrectas.";
    }else if(request()->has('no_activo')){
        $error = "Este usuario no esta activado.";
    }else{
        $error = false;
    }
    return view('login')->with('err',$error);
});

Route::post('/usuarios/activar', 'UsuariosController@activar');
Route::post('/usuarios/nuevo', 'UsuariosController@nuevo');
Route::post('/usuarios/eliminar', 'UsuariosController@eliminar');
Route::post('/usuarios/entrar', 'UsuariosController@entrar');
Route::post('/usuarios/salir', 'UsuariosController@salir');
Route::post('/usuario/editar', 'UsuariosController@editar');
Route::get('/usuarios/{id}', 'UsuariosController@verEditar');








