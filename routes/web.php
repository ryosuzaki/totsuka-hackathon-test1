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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#避難所　登録　参照　
Route::get('shelter-info/{id}', 'SheltersController@info')->name('shelter_info');

Route::get('register-shelter', function () {
    return view('shelters.register');
})->name('shelter_register');

Route::post('register-shelter', 'SheltersController@register');

#サポートチーム　登録　参照
Route::get('support-team-info/{id}', 'SupportTeamsController@info')->name('support_team_info');

Route::get('register-support-team', function () {
    return view('support_teams.register');
})->name('support_team_register');

Route::post('register-support-team', 'SupportTeamsController@register');