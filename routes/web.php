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
$router->get('/login/setNewPassword/{id}', 'LoginController@setNewPassword');
$router->post('/login/setNewPassword/{id}', 'LoginController@processNewPassword');
$router->get('/logout', ['middleware' => 'auth', 'uses' => 'LoginController@logout']);

// Normal pages
$router->get('/', ['middleware' => 'auth', 'uses' => 'MainController@home']);
$router->get('/profile', ['middleware' => 'auth', 'uses' => 'MainController@profile']);
$router->get('/bar', ['middleware' => 'auth', 'uses' => 'MainController@bar']);
$router->post('/bar', ['middleware' => 'auth', 'uses' => 'MainController@processBar']);
$router->post('/bar/add_credit', ['middleware' => 'auth', 'uses' => 'MainController@processBarAddCredit']);
$router->get('/bows', ['middleware' => 'auth', 'uses' => 'MainController@bows']);
$router->post('/bows', ['middleware' => 'auth', 'uses' => 'MainController@processBow']);

// Board only
$router->get('/board', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@home']);
$router->get('/board/bar', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@bar']);
$router->post('/board/bar/add_credit', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@addBarCredit']);
$router->get('/board/payments', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@payments']);
$router->get('/board/bows', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@bows']);
$router->get('/board/members/add', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@addMember']);
$router->post('/board/members/add', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@addMemberPost']);
$router->get('/board/payment/add', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@customPayment']);
$router->post('/board/payment/add', ['middleware' => ['auth', 'board'], 'uses' => 'AdminController@customPaymentPost']);

// Payment
$router->get('/pay/{id}', 'PaymentController@pay');
$router->post('/pay/{id}', 'PaymentController@processPay');
