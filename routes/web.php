<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

//menggunakan route group prefixes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('motor',  ['uses' => 'MotorController@showAllMotor']);
    $router->get('motor/{id}', ['uses' => 'MotorController@showOneMotor']);
    $router->post('motor', ['uses' => 'MotorController@create']);
    $router->delete('motor/{id}', ['uses' => 'MotorController@delete']);
    $router->put('motor/{id}', ['uses' => 'MotorController@update']);
});
