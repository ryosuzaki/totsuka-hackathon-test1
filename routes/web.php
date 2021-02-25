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
use App\Shelter;
use App\SupportTeam;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//
Route::get('shelter/search',function () {
    return view('shelter.search');
})->name('shelter.search');
//避難所 ホーム
Route::get('shelter/{id}/home',function ($id) {
    return view('shelter.home')->with(['shelter' => Shelter::find($id)]);
})->name('shelter.home');
//避難所ページへ
Route::get('shelter/{id}/info', function($id){
    return view('shelter.info')->with(['shelter' => Shelter::find($id)]);
})->name('shelter.info');
Route::get('shelter/search',function(){return view('shelter.search');})->name('shelter.search.get');
Route::post('shelter/search','SheltersController@search')->name('shelter.search.post');


//サポートチーム ホーム
Route::get('support-team/{id}/home',function ($id) {
    return view('support_team.home')->with(['support_team' => SupportTeam::find($id)]);
})->name('support-team.home');
//サポートチームページへ
Route::get('support-team/{id}/info', function($id){
    return view('support_team.info')->with(['support_team' => SupportTeam::find($id)]);
})->name('support_team.info');
Route::get('support_team/search',function(){return view('support_team.search');})->name('support_team.search.get');
Route::post('support-team/search', 'SupportTeamsController@search')->name('support_team.search.post');

// ユーザ登録済みのみ
Route::group(['middleware' => 'auth'], function () {
    //ユーザー ホーム
    Route::get('user/home',function () {
        return view('user.home');
    })->name('user.home');
    //ユーザー情報
    Route::get('user/{id}/info',function($id){
        return view('user.info')->with(['user' => User::find($id)]);
    })->name('user.info');
    //ユーザー編集
    Route::get('user/edit',function () {
        return view('user.edit')->with(['user' => User::find(Auth::id())]);
    })->name('user.edit.get');
    Route::post('user/edit','UsersController@edit')->name('user.edit.post');
    //ユーザー所属一覧
    Route::get('user/belong','UsersController@belong')->name('user.belong');

    
    //避難所所属登録
    Route::get('shelter/{id}/join','SheltersController@join')->name('shelter.join');
    Route::post('shelter/{id}/join-staff', 'SheltersController@join_staff')->name('shelter.join_staff');
    Route::post('shelter/{id}/join-user', 'SheltersController@join_user')->name('shelter.join_user');
    //避難所編集
    Route::get('shelter/{id}/edit',function($id){
        return view('shelter.edit')->with(['shelter' => Shelter::find($id) ]);
    })->middleware('can:shelter-staff,id')->name('shelter.edit.get');
    Route::post('shelter/{id}/edit','SheltersController@edit')->name('shelter.edit.post');
    //避難所登録
    Route::get('shelter/register', function () {
        return view('shelter.register');
    })->name('shelter.register.get');//->middleware('can:admin-user')
    Route::post('shelter/register', 'SheltersController@register')->name('shelter.register.post');


    //サポートチーム所属登録
    Route::get('support-team/{id}/join', function ($id) {
        return view('support_team.join',['support_team'=>SupportTeam::find($id)]);
    })->name('support_team.join');
    Route::post('support-team/{id}/join-staff', 'SupportTeamsController@join_staff')->name('support_team.join_staff');
    Route::post('support-team/{id}/join-user', 'SupportTeamsController@join_user')->name('support_team.join_user');

    //サポートチーム編集
    Route::get('support-team/{id}/edit', function ($id) {
        return view('support_team.edit')->with(['support_team' => SupportTeam::find($id)]);
    })->name('support_team.edit.get')->middleware('can:support-staff,id');;
    Route::post('support-team/{id}/edit', 'SupportTeamsController@edit')->name('support_team.edit.post');

    //サポートチーム登録
    Route::get('support-team/register', function () {
        return view('support_team.register');
    })->name('support_team.register.get');
    Route::post('support-team/register', 'SupportTeamsController@register')->name('support_team.register.post');
    //サポートチームの利用者情報
    Route::get('support-team/{id}/users',function ($id) {
        $users=SupportTeam::find($id)->support_users()->get();
        foreach ($users as $user){
            $safeties[]=optional($user->safety_questionnaires()->latest()->first());
            $healths[]=optional($user->health_questionnaires()->latest()->first());
        }
        return view('support_team.users')->with([
            'support_team' => SupportTeam::find($id),
            'support_users'=>$users,
            'latest_safeties'=>$safeties,
            'latest_healths'=>$healths,
            'self'=>User::find(Auth::id()),
            ]);
    })->name('support_team.users.get');
    Route::post('support-team/{id}/users','SupportTeamsController@users')->name('support_team.users.post');
    

    //アンケート ホーム 
    Route::get('questionnaire/home', function () {
        return view('questionnaire.home');
    })->name('questionnaire.home');
    //アンケート
    Route::get('questionnaire/{type}/form', function ($type) {
        return view('questionnaire.'.$type.'.form');
    })->name('questionnaire.form.get');
    Route::post('questionnaire/{type}/form', 'QuestionnairesController@form')->name('questionnaire.form.post');
    Route::get('questionnaire/{type}/{id}/answers','QuestionnairesController@answers')->name('questionnaire.answers');
    Route::get('questionnaire/{type}/{user_id}/answer/{answer_id}','QuestionnairesController@answer')->name('questionnaire.answer');
});
