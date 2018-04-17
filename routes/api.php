<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1',],
    function () {
        Route::group(['prefix' => 'token',
            'namespace' => '\Coccoc\Handler\Http\Controllers'], function () {
            Route::post('/generate', [
                'as' => 'token.generate',
                'uses' => 'TokenController@generate'
            ]);
            Route::post('/validate', [
                'as' => 'token.validate',
                'uses' => 'TokenController@check'
            ]);
            Route::post('/revoke', [
                'as' => 'token.revoke',
                'uses' => 'TokenController@revoke'
            ]);
        });
        Route::get('/ping', function () {
            return (new \Illuminate\Http\Response)->setStatusCode(200);
        });
    }
);