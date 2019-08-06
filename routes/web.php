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

$router->get('/login', 'LoginController@login');
$router->post('/login', 'LoginController@processLogin');
$router->get('/logout', ['middleware' => 'auth', 'uses' => 'LoginController@logout']);
$router->get('/', ['middleware' => 'auth', 'uses' => 'MainController@home']);
$router->get('/profile', ['middleware' => 'auth', 'uses' => 'MainController@profile']);
$router->get('/bar', ['middleware' => 'auth', 'uses' => 'MainController@bar']);
$router->post('/bar', ['middleware' => 'auth', 'uses' => 'MainController@processBar']);
$router->get('/bows', ['middleware' => 'auth', 'uses' => 'MainController@bows']);
$router->post('/bows', ['middleware' => 'auth', 'uses' => 'MainController@processBow']);
