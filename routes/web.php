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


    //Items routes
    Route::get('/', 'OrderController@index')->name('items.index');
    Route::post('items/filter', 'OrderController@index')->name('items.filter');
    Route::get('add/Items', 'OrderController@addItems')->name('add.items');
    Route::post('items/store', 'OrderController@storeItems')->name('items.store');
    Route::get('items/edit/{id}', 'OrderController@editItems')->name('edit.items');
    Route::put('items/update/{id}', 'OrderController@updateItems')->name('items.update');
    Route::delete('items/delete/{id}', 'OrderController@destroyItems')->name('items.delete');
  
    Route::get('gamerdatafetch/{id}', 'OrderController@datafetch');
  
    Route::get('coachd_details_fetch/{id}', 'OrderController@CoachDataFetch');
  
    Route::post('tip_a_coach', 'OrderController@TipAcoach');
  
    Route::get('/wallet', 'OrderController@wallet')->name('gamer.wallet');

     //Attributes routes
    Route::get('/attributes', 'OrderController@attributes')->name('attributes');
    Route::get('add/attributes', 'OrderController@addAttr')->name('add.attributes');
    Route::post('attribute/store', 'OrderController@storeAttributes')->name('attributes.store');
    Route::get('attribute/edit/{id}', 'OrderController@editAttribute')->name('edit.attribute');
    Route::put('attribute/update/{id}', 'OrderController@updateAttribute')->name('attribute.update');
    Route::delete('attribute/delete/{id}', 'OrderController@destroy')->name('attribute.delete');

    //Categories routes
    Route::get('/categories', 'OrderController@categories')->name('categories');
    Route::get('add/categories', 'OrderController@addCategories')->name('add.categories');
    Route::post('categories/store', 'OrderController@storeCategories')->name('categories.store');
    Route::get('categories/edit/{id}', 'OrderController@editCategories')->name('edit.categories');
    Route::put('categories/update/{id}', 'OrderController@updateCategories')->name('categories.update');
    Route::delete('categories/delete/{id}', 'OrderController@destroyCategories')->name('categories.delete');

    //Sub_Categories routes
    Route::get('/sub_categories', 'OrderController@sub_categories')->name('sub_categories');
    Route::get('add/sub_categories', 'OrderController@addSubCategories')->name('add.sub_categories');
    Route::post('sub_categories/store', 'OrderController@storeSubCategories')->name('sub_categories.store');
    Route::get('sub_categories/edit/{id}', 'OrderController@editSubCategories')->name('edit.sub_categories');
    Route::put('sub_categories/update/{id}', 'OrderController@updateSubCategories')->name('sub_categories.update');
    Route::delete('sub_categories/delete/{id}', 'OrderController@destroySubCategories')->name('sub_categories.delete');

    //Countries routes
    Route::get('/countries', 'OrderController@countries')->name('countries');
    Route::get('add/countries', 'OrderController@addCountries')->name('add.countries');
    Route::post('countries/store', 'OrderController@storeCountries')->name('countries.store');
    Route::get('countries/edit/{id}', 'OrderController@editCountries')->name('edit.countries');
    Route::put('countries/update/{id}', 'OrderController@updateCountries')->name('countries.update');
    Route::delete('countries/delete/{id}', 'OrderController@destroyCountries')->name('countries.delete');

    //Areas routes
    Route::get('/areas', 'OrderController@areas')->name('areas');
    Route::get('add/areas', 'OrderController@addAreas')->name('add.areas');
    Route::post('areas/store', 'OrderController@storeAreas')->name('areas.store');
    Route::get('areas/edit/{id}', 'OrderController@editAreas')->name('edit.areas');
    Route::put('areas/update/{id}', 'OrderController@updateArea')->name('areas.update');
    Route::delete('areas/delete/{id}', 'OrderController@destroyArea')->name('areas.delete');


    //Store routes
    Route::get('/store','OrderController@storee')->name('store');

    Route::get('edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/edit/{id}','UserController@profileupdate')->name('gamer.update');

    