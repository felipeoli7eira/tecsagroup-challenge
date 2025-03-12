<?php

use Pecee\SimpleRouter\SimpleRouter as Route;

Route::group(['prefix' => '/api'], function (): void {
    Route::post('/todo', 'TaskController@create');
    Route::put('/todo/{id}/update', 'TaskController@update');
    Route::get('/todo', 'TaskController@read');
    Route::get('/todo/{id}', 'TaskController@readOne');
    Route::delete('/todo/{id}/delete', 'TaskController@delete');
});
