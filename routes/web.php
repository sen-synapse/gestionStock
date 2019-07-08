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

Route::get('/testhome', 'HomeController@test')->name('testhome');
Route::get('/test', 'TestController@index')->name('test');
Route::get('/about', 'TestController@about')->name('about');

/*Route de la gestion de la facturation RC-GS*/
Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware('auth')->group(function(){

	Route::get('/', 'HomeController@index')->name('home');

	Route::resource('/categories', 'CategoriesController');
  Route::post('{id}/categories', [
    'uses' => 'CategoriesController@modifier',
    'as' => 'categories.modifier'
  ]);

  Route::resource('/souscategories', 'SousCategoriesController');
  Route::post('/{id}/sousCategorie', [
    'uses' => 'SousCategoriesController@update',
    'as' => 'souscategories.update'
  ]);

	Route::resource('/articles', 'ArticleController');
  Route::post('/{id}/articles', [
    'uses' => 'ArticleController@update',
    'as' => 'articles.update'
  ]);

	Route::resource('/fournisseurs', 'FournisseursController');

  Route::resource('/articlerecus', 'ArticleRecusController');
  Route::post('/{id}/articlerecus', [
    'uses' => 'ArticleRecusController@update',
    'as' => 'articlerecus.update'
  ]);

  Route::get('{id}/articlerecus', [
    'uses' => 'ArticleRecusController@ajouter',
    'as' => 'articlerecus.ajouter'
  ]);

	Route::resource('/bordereaufournisseurs', 'BordereauFournisseursController');
  Route::resource('/utilisateurs', 'UtilisateursController');
});

/*Route de la gestion de la facturation RC-GF*/
Route::namespace('AdminGF')->prefix('admingf')->as('admingf.')->middleware('auth')->group(function(){

    Route::get('/', 'HomeController@index')->name('homegf');
    /*
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/news', 'NewsController');
    Route::resource('/fournisseurs', 'FournisseursController');
    Route::resource('/bordereaufournisseurs', 'BordereauFournisseursController');
    */
});

/*Route de la gestion de la paie RC-GP*/
Route::namespace('AdminGP')->prefix('admingp')->as('admingp.')->middleware('auth')->group(function(){

    Route::get('/', 'HomeController@index')->name('homegp');
    /*
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/news', 'NewsController');
    Route::resource('/fournisseurs', 'FournisseursController');
    Route::resource('/bordereaufournisseurs', 'BordereauFournisseursController');
    */
});

/*Route de la gestion des etats financiers RC-GEF*/
Route::namespace('AdminGEF')->prefix('admingef')->as('admingef.')->middleware('auth')->group(function(){

    Route::get('/', 'HomeController@index')->name('homegef');
    /*
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/news', 'NewsController');
    Route::resource('/fournisseurs', 'FournisseursController');
    Route::resource('/bordereaufournisseurs', 'BordereauFournisseursController');
    */
});
