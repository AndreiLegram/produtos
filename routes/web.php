<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'produtos'], function() use ($router) {
    $router->get('', ['as' => 'products.index', 'uses' => 'ProductController@index']);
    $router->get('{id}', ['as' => 'products.show', 'uses' => 'ProductController@show']);
    $router->post('', ['as' => 'products.create', 'uses' => 'ProductController@create']);
    $router->put('{id}', ['as' => 'products.update', 'uses' => 'ProductController@update']);
    $router->patch('{id}/ativar', ['as' => 'products.activate', 'uses' => 'ProductController@activate']);
    $router->patch('{id}/inativar', ['as' => 'products.inactivate', 'uses' => 'ProductController@inactivate']);
    $router->delete('{id}', ['as' => 'products.destroy', 'uses' => 'ProductController@destroy']);

    $router->group(['prefix' => '{produtos_id}/interesses'], function() use ($router) {
        $router->get('', ['as' => 'product_interests.index', 'uses' => 'ProductInterestController@index']);
        $router->get('{id}', ['as' => 'product_interests.show', 'uses' => 'ProductInterestController@show']);
        $router->post('', ['as' => 'product_interests.create', 'uses' => 'ProductInterestController@create']);
        $router->put('{id}', ['as' => 'product_interests.update', 'uses' => 'ProductInterestController@update']);
        $router->patch('{id}/ativar', ['as' => 'product_interests.activate', 'uses' => 'ProductInterestController@activate']);
        $router->patch('{id}/inativar', ['as' => 'product_interests.inactivate', 'uses' => 'ProductInterestController@inactivate']);
        $router->delete('{id}', ['as' => 'product_interests.destroy', 'uses' => 'ProductInterestController@destroy']);
    });
});
