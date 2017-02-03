<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/photos', 'PhotosController@nav')->name('photos');

Route::get('/about', function(){
  return view('pages/about');
})->name('about');

Route::get('/contact', function(){
  return view('pages/contact');
})->name('contact');

Route::get('/work', 'WorkController@nav')->name('work');
Route::get('/work/{link}', 'WorkController@detail')->name('work.detail');



Route::group(['prefix' => 'admin','middleware' => 'auth'], function (){

  Route::group(['prefix' => 'work'], function(){

    Route::get('/index', 'WorkController@index' )->name('work.index');
    Route::any('/create', 'WorkController@create' )->name('work.create');
    Route::any('/update/{id}', 'WorkController@update' )->name('work.update');
    Route::get('/remove/{id}', 'WorkController@remove')->name('work.remove');

  });

  Route::group(['prefix' => 'photos'], function(){

    Route::get('/index', 'PhotosController@index' )->name('photos.index');
    Route::any('/create', 'PhotosController@create' )->name('photos.create');
    Route::any('/update/{id}', 'PhotosController@update' )->name('photos.update');
    Route::get('/remove/{id}', 'PhotosController@remove')->name('photos.remove');
  });

  Route::group(['prefix' => 'categories'], function(){

    Route::get('/index', 'CategoriesController@index' )->name('categories.index');
    Route::any('/create', 'CategoriesController@create' )->name('categories.create');
    Route::any('/update/{id}', 'CategoriesController@update' )->name('categories.update');
    Route::get('/remove/{id}', 'CategoriesController@remove')->name('categories.remove');

  });

  Route::group(['prefix' => 'images'], function(){
    Route::get('/index', 'ImagesController@index' )->name('images.index');
    Route::any('/create', 'ImagesController@create' )->name('images.create');
    Route::get('/remove/{id}', 'ImagesController@remove')->name('images.remove');
  });
});

Auth::routes();
