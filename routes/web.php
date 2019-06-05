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


//google map
Route::get('/map', function() {
    return view('location.index');
});



Route::group(['middleware'=> ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/chart', 'FoodsController@charts');


    //food

    Route::get('/foods', 'FoodsController@index');
    Route::get('/foods/create', 'FoodsController@create');
    Route::post('/foods', 'FoodsController@store');
    Route::get('/foods/{food}', 'FoodsController@show');
    Route::get('/foods/{food}/edit', 'FoodsController@edit');
    Route::get('/foods/{food}/buy', 'FoodsController@buy');
    Route::patch('/foods/{food}', 'FoodsController@update');
    Route::delete('/foods/{food}/delete', 'FoodsController@destroy');


    //search
    Route::get('/search', 'SearchController@index');
    Route::post('/search/find', 'SearchController@find');

    //profiles
    Route::get('/profiles', 'ProfilesController@index');
    Route::get('/profiles/{profile}/edit', 'ProfilesController@edit');
    Route::patch('/profiles/{profile}', 'ProfilesController@update');
    Route::get('/profiles/{user_id}/details', 'ProfilesController@show');
    Route::get('/bought', 'ProfilesController@getBought');



    //reviews
    Route::get('/profiles/{user_id}/comments', 'ReviewController@index');  
    Route::get('/profiles/{review}', 'ReviewController@show');
    Route::get('/profiles/{review}/edit', 'ReviewController@edit');
    Route::delete('/profiles/{review}/delete', 'ReviewController@destroy');
    Route::post('/profiles', 'ReviewController@store');

    //likes
    Route::post('/profiles/{profile}/like', 'LikesController@likesAction');

    //ajax
    Route::get('/ajax-district', 'SearchController@ajax');
    // Route::get('/ajax-subdistrict', 'SearchController@ajax2');


    //beli
    Route::get('/cart/{id}', 'FoodsController@cart');
    Route::get('/carthome/{id}', 'FoodsController@carthome');
    Route::get('/reduce/{id}', 'FoodsController@getReduceByOne')->name('food.reduce');
    Route::get('/reducehome/{id}', 'FoodsController@getReduceByOneHome')->name('food.reducehome');
    Route::get('/remove/{id}', 'FoodsController@getRemoveItem')->name('food.remove');

    Route::get('/shopping-cart', 'FoodsController@getCart')->name('product.shoppingCart');
    Route::get('/orders', 'ProfilesController@getOrder')->name('profile.order');
    Route::get('/checkout', 'FoodsController@getCheckout')->name('checkout');
    Route::post('/checkout', 'FoodsController@postCheckout')->name('checkout');



    Route::post('location', function () {

        $latitude = request('latitude');
        $longitude = request('longitude');

       return "latitude = $latitude and longitude = $longitude";

    })->name('handle.location');


    // Route::resource('foods', 'FoodsController');


});

Auth::routes();

    // //order
    // Route::get('/orders', 'OrdersController@index');
    // Route::get('/orders/create', 'OrdersController@create');
    // Route::post('/orders', 'OrdersController@store');
    // Route::get('/orders/{order}', 'OrdersController@show');
    // Route::get('/orders/{order}/edit', 'OrdersController@edit');
    // Route::patch('/orders/{order}', 'OrdersController@update');
    // Route::delete('/orders/{order}/delete', 'OrdersController@destroy');