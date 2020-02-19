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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
// });

Route::middleware('auth:api')->get('/user', function(Request $request) {
  return $request->user();
});

Route::group(['prefix' => '', 'middleware' => 'cors'], function () {
  Route::get('users/search', 'User\UserController@search');
  Route::get('publications/search', 'Publication\PublicationController@search');
  Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
  Route::resource('publications', 'Publication\PublicationController', ['except' => ['create', 'edit']]);
  Route::resource('users.publications', 'User\UserPublicationController', ['only' => ['index']]);
  Route::resource('users.loans', 'User\UserLoanController', ['only' => ['index']]);
  Route::resource('users.loansHistoric', 'User\UserLoanHistoricController', ['only' => ['index']]);
  Route::resource('users.requestionsSent', 'User\UserRequestionsSentController', ['only' => ['index']]);
  Route::resource('users.requestionsReceived', 'User\UserRequestionsReceivedController', ['only' => ['index']]);
  Route::resource('images', 'Publication\ImageController', ['except' => ['create', 'edit']]);
  Route::resource('publications.images', 'Publication\PublicationImageController', ['only' => ['index']]);
  Route::resource('loans', 'Requestion\LoanController', ['except' => ['create', 'edit']]);
  Route::resource('requestions', 'Requestion\RequestionController', ['except' => ['create', 'edit']]);
  Route::resource('conditions', 'Condition\ConditionController', ['except' => ['create', 'edit']]);
  Route::resource('publications.conditions', 'Publication\PublicationConditionController', ['only' => ['index']]);
  // Route::resource('links', 'Link\LinkController', ['except' => ['create', 'edit']]);
  Route::resource('categories', 'Category\CategoryController', ['only' =>['index']]);
});

Route::group(['prefix' => 'auth', 'middleware' => 'cors'], function () {
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
});

