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

//Raiz-index
Route::get('/', 'IndexController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post('password/question', 'Auth\ForgotPasswordController@validateQuestionsForm')->name('password.question');
Route::post('password/question/reset', 'Auth\ForgotPasswordController@resetPassword')->name('passwordq.request');
//Admin
//Registrar como administrador
Route::post('/registro','AdminController@registro');

//perfil usuarios
Route::get('/perfil','PerfilController@list')->middleware('auth')->name('perfil');
Route::get('/perfil/{user}','PerfilController@show')->middleware('auth')->name('perfil-user');
Route::post('/perfil','PerfilController@edit')->middleware('auth')->name('edit-perfil');
Route::post('/perfil-preguntas','PerfilController@editPreguntas')->middleware('auth')->name('edit-perfil-preguntas');

//consultas
Route::get('/consulta', 'ConsultaController@create')->middleware('auth')->name('consulta-crear');
Route::post('/consulta', 'ConsultaController@save')->middleware('auth')->name('consulta-save');
Route::get('/consultas','ConsultaController@list')->middleware('auth')->name('consultas');
Route::get('/consultas/{consulta}','ConsultaController@show')->middleware('auth')->name('consulta-show');
Route::post('/consultas/{consulta}/save-diagnostico','ConsultaController@saveDiagnostico')->middleware('auth')->name('consulta-save-diagnostico');


