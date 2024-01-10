<?php

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
	if (Auth::check()){
        return Redirect::to('/home');   
        }
    return view('auth.login');
});

Auth::routes([
	'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects', 'ProjectController@index')->name('projects.index');
Route::get('/projects/{project}', 'ProjectController@show')->name('projects.show');
Route::get('/project1/camera', 'ProjectController@camera1')->name('projects.camera1');
Route::get('/project1/run', 'ProjectController@redirectIndex');
Route::get('/project2/run', 'ProjectController@redirectIndex');
Route::post('/project1/run', 'ProjectController@validarProject1')->name('project1.validar');
Route::post('/project2/run', 'ProjectController@validarProject2')->name('project1.validar2');
Route::get('/project1/download/{idData}', 'ProjectController@project1Download')->name('project1.download');
Route::get('/docentes', 'UserController@docentes')->name('docentes.index');
Route::get('/estudiantes', 'UserController@estudiantes')->name('estudiantes.index');
Route::get('/guiaSensorica', 'ProjectController@guiaSensorica')->name('guiaSensorica');

Route::get('/userPrueba', 'UserController@testCrear');
Route::resource('appointments','AppointmentController');
Route::resource('parameters','ParameterController');



//Modificacion EDWAR
// Mostrar formulario de registro
Route::get('/estudiantes/registrar', 'EstudianteController@showForm')->name('estudiantes.registrar');
// Procesar el formulario de registro
Route::post('/estudiantes/registrar', 'EstudianteController@store')->name('estudiantes.store');

