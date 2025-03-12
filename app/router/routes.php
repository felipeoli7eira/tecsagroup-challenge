<?php

use Pecee\SimpleRouter\SimpleRouter as Route;

Route::get('/', 'TaskController@renderHomePage');
Route::get('/cadastro', 'TaskController@renderCreateTaskPage');
Route::get('/edicao/{id}', 'TaskController@renderEditTaskPage');

Route::group(['prefix' => '/api'], function (): void {
    Route::post('/task', 'TaskController@create');
    Route::put('/task/{id}/update', 'TaskController@update');
    Route::get('/tasks', 'TaskController@read');
    Route::get('/task/{id}', 'TaskController@readOne');
    Route::delete('/task/{id}/delete', 'TaskController@delete');
});
