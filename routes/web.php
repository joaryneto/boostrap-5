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

Route::get('/teste', function () {
    return view('welcome');
});

Route::get('/login2', function () {
    return view('login');
});

Route::get('/verifyy', function () {
    return view('auth.verify');
})->name('verify');

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */

    Route::group(['middleware' => ['auth']], function() {

    Route::get('/users', 'LoginController@users')->name('users.perform');
    Route::post('/users', 'LoginController@store')->name('store.perform');

    Route::get('/users/autenticado', 'LoginController@autenticado')->name('autenticado.perform');
    Route::get('/ranking', 'HomeController@GetRanking')->name('ranking.perform');

    Route::get('/api/igrejas', 'LoginController@igrejas')->name('igrejas.perform');
    Route::get('/users/pg', 'LoginController@pg')->name('pg.perform');
    Route::post('/users/createpg', 'LoginController@CreatePG')->name('pgstore.perform');

    Route::post('/users/create', 'LoginController@criar')->name('create.perform');
    Route::get('/users/supervisor', 'LoginController@GetClasse')->name('supervisor.perform');
    Route::post('/users/supervisor', 'LoginController@StoreSupervisor')->name('StoreSupervisor.perform');
    Route::delete('/users/{id}', 'LoginController@delete')->name('delete.perform');

    Route::get('/inicio', 'HomeController@index')->name('home.index');
    Route::get('/perguntas', 'PerguntasController@show')->name('perguntas.show');
    Route::get('/perguntas/admin', 'PerguntasController@showAdm')->name('perguntas.showAdm');
    Route::post('/perguntas/admin/store', 'PerguntasController@AdicionarPontos')->name('perguntas.AdicionarPontos');
    Route::post('/perguntas/store', 'PerguntasController@store')->name('perguntas.store');
    Route::post('/perguntas/create', 'PerguntasController@adicionar')->name('perguntas.adicionar');

    });

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        Route::post('/login2', 'LoginController@login2')->name('login2.perform');
        Route::post('/verify', 'LoginController@verify')->name('verify.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */


        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
