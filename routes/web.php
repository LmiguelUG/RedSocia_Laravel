<?php

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/configuracion', 'UserController@config')->name('user.config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{file_name}', 'UserController@getImage')->name('user.avatar');
Route::get('/image/upload', 'ImageController@upload')->name('image.upload');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/get/{file_name}', 'ImageController@getImage')->name('image.getImage');
Route::get('/home/news', 'HomeController@index')->name('home.index');
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::get('/likes/{id}', 'LikeController@likes')->name('like.likes');
Route::get('/like/{image_id}', 'LikeController@like')->name('like.like');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.dislike');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/delete/{id}', 'ImageController@delete')->name('image.delete');
