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

$app->get('/', function () use ($app) {
    return $app->version();
});


/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/

$app->get('users/create/admin', 'UserController@createAdmin');

$app->group(['middleware' => 'auth:api'], function($app)
{
    $app->get('/test', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

$app->post('auth/login', 'AuthController@postLogin');


/*
|--------------------------------------------------------------------------
| REST Routes
|--------------------------------------------------------------------------
*/

// Users

// Tasks

$app->get('/tasks', 'TaskController@index');
$app->get('/tasks/{id}', 'TaskController@show');
$app->post('/tasks', 'TaskController@store');
$app->put('/tasks/{id}', 'TaskController@update');
$app->delete('/tasks/{id}', 'TaskController@destroy');


// Priorities

$app->get('/priorities', 'PriorityController@index');
$app->get('/priorities/{id}', 'PriorityController@show');
$app->post('/priorities', 'PriorityController@store');
$app->put('/priorities/{id}', 'PriorityController@update');
$app->delete('/priorities/{id}', 'PriorityController@destroy');




