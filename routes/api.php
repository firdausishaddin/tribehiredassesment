<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'comment'], function () {
    Route::get('/filter', 'CommentController@filter');
    // Route::get("/", "CommentController@index");
    // Route::get("/{id}", "CommentController@show");
    // Route::get("/{id}", "CommentController@edit");
    // Route::patch("/{id}", "CommentController@update");
    // Route::delete("/{id}", "CommentController@delete");
});

// Route::group(['prefix' => 'post'], function () {
//     Route::get("/", "PostController@index");
//     Route::get("/{id}", "PostController@show");
//     Route::get("/{id}", "PostController@edit");
//     Route::patch("/{id}", "PostController@update");
//     Route::delete("/{id}", "PostController@delete");
// });


Route::apiResources([
    'comment' => 'CommentController',
    'post' => 'PostController',
]);
