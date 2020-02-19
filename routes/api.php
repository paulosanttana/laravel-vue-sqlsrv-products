<?php

// ROTAS API -------------------------------------------------------------

// Route::get('categories', 'Api\CategoryController@index');
// Route::post('categories', 'Api\CategoryController@store');
// Route::put('categories/{id}', 'Api\CategoryController@update');
// Route::delete('categories/{id}', 'Api\CategoryController@destroy');

// Rota JWT
Route::post('auth', 'Auth\AuthApiController@authenticate');
Route::post('auth-refresh', 'Auth\AuthApiController@refreshToken');
Route::get('me', 'Auth\AuthApiController@getAuthenticatedUser');

// Rota API Simplificada (index, store, update, destroy). ----------------

Route::group([
    'prefix' => 'v1', 
    'namespace' => 'Api\v1', 
    // 'middleware' => 'auth:api'  //Adicondo driver jwt definido no array guards[] do arquivo auth.php. 
], function(){

    Route::get('categories/{id}/products', 'CategoryController@products');
    Route::apiResource('categories', 'CategoryController');
    
    Route::apiResource('products', 'ProductController');
    
});
