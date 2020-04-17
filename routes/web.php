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

// Web route for single-page response

$router->get('/', [
	'as' => 'index', 'uses' => 'WebController@index'
]);

// Api routes for fetching Station Codes and Train Times
$router->group(['prefix' => 'api'], function() use ($router) {
	$router->get('/lines/{line}', [
		'as' => 'lines.show', 'uses' => 'APIController@index'
	]);
    $router->get('/lines/{line}/stations/{station}', [
        'as' => 'stations.show', 'uses' => 'APIController@show'
	]);
});
