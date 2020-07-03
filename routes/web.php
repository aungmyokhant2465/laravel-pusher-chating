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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'home','middleware'=>'auth'], function () {

    Route::group(['prefix' => 'friends'], function () {
        Route::get('/',[
            'uses'=>'FriendController@index',
            'as'=>'get.friends'
        ]);

        Route::get('/friends','FriendController@friends');
    
        Route::get('/confirm/{friend_id}',[
            'uses'=> 'FriendController@confirm',
            'as'=>'get.friends.confirm'
        ]);
    
        Route::get('/reject/{friend_id}',[
            'uses'=>'FriendController@reject',
            'as'=>'get.friends.reject'
        ]);
    
        Route::get('/request',[
            'uses'=>'FriendController@request',
            'as'=>'get.friends.request'
        ]); 
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', [
            'uses'=>'ChatsController@index',
            'as'=>'get.chat'
        ]);
        Route::get('messages/{receiver_id}', [
            'uses'=>'ChatsController@fetchMessages',
            'as'=>'get.messages'
        ]);
        Route::post('messages', [
            'uses'=>'ChatsController@sendMessage',
            'as'=>'post.messages'
        ]);
    });
});

Route::get('messages/{receiver_id}', [
    'uses'=>'ChatsController@fetchMessages',
    'as'=>'get.messages'
]);

