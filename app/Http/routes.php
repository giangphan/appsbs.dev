<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::group(['prefix'=>'order'], function(){
    Route::get('getOrderData', ['as' => 'getOrderData', 'uses' => 'OrderController@getOrderData']);
    Route::post('/{id}', ['as' => 'getOrderStatus', 'uses' => 'OrderController@getOrderStatus']);
    Route::post('/status/{id}', ['as' => 'updateOrderStatus','uses' => 'OrderController@updateOrderStatus']);
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('/',['as' => 'dashboard', function () {
    return view('dashboard');
}]);
Route::get('/datatables/dataOrders', ['as' => 'datatables.dataOrders', 'uses' => 'DatatablesController@dataOrders']);
Route::resource('order', 'OrderController');
Route::resource('product', 'ProductController');
Route::resource('user','UserController');
// Route::get('/user',['as' => 'user.index', 'uses' => 'UserController@index']);
// Route::get('/user/create',['as' => 'user.create', 'uses' => 'UserController@create']);
// Route::post('/user/create',['as' => 'user.store', 'uses' => 'UserController@store']);
// Route::resource('user','UserController',['except' => ['store']]);
});




