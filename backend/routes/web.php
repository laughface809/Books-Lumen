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

$router->post('/login', 'UserController@login');
$router->post('/reset', 'UserController@sendResetToken');
$router->put('/reset/{token}', 'UserController@verifyResetPassword');

$router->group(['middleware' => 'auth'], function() use($router) {
    $router->get('/users', 'UserController@index');
    $router->post('/users', 'UserController@store');
    $router->get('/users/login', 'UserController@getUserLogin');
    $router->get('/users/{id}', 'UserController@edit');
    $router->put('/users/{id}', 'UserController@update');
    $router->delete('/users/{id}', 'UserController@destroy');

    $router->get('/categories', 'CategoryController@index');
    $router->post('/categories', 'CategoryController@store');
    $router->get('/categories/{id}', 'CategoryController@edit');
    $router->put('/categories/{id}', 'CategoryController@update');
    $router->delete('/categories/{id}', 'CategoryController@destroy');

    $router->get('/books', 'BooksController@index');
    $router->post('/books', 'BooksController@store');
    $router->get('/books/{id}', 'BooksController@edit');
    $router->put('/books/{id}', 'BooksController@update');
    $router->delete('/books/{id}', 'BooksController@destroy');

    $router->post('/logout', 'UserController@logout');
});
