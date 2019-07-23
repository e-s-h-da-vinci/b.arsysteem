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

use ESHDaVinci\API\Client;

$router->get('/', function (Client $client) use ($router) {
    $members = $client->getListOfNames(true);
    asort($members);
    return view('login', ['members' => $members]);
});

$router->get('/auth', ['middleware' => 'auth', function () use ($router) {
    return $router->app->version();
}]);
