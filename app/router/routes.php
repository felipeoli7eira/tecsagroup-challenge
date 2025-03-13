<?php

use Pecee\SimpleRouter\SimpleRouter as Route;

Route::get('/', 'TaskController@renderHomeScreen');
Route::get('/cadastro', 'TaskController@renderCreateScreen');
Route::get('/edicao/{id}', 'TaskController@renderUpdateScreen');

Route::group(['prefix' => '/api'], function (): void {
    Route::post('/task', 'TaskController@create');
    Route::put('/task/{id}/update', 'TaskController@update');
    Route::get('/tasks', 'TaskController@read');
    Route::get('/task/{id}', 'TaskController@readOne');
    Route::delete('/task/{id}/delete', 'TaskController@delete');

    // Auth

    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/logout', 'AuthController@logout');
});
