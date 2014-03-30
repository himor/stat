<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Open routes
 */

Route::pattern('id', '[0-9]+');
Route::get('/', array('as' => 'root', 'uses' => 'IndexController@showIndex'));

/**
 * Administering
 */

Route::when('do/*', 'auth');
Route::get('do', array('before' => 'auth', 'uses' => 'AdminController@showAdmin'));
Route::get('do/tokens', array('as' => 'do/tokens', 'uses' => 'AdminController@tokensAdmin'));
Route::get('do/users', array('as' => 'do/users', 'uses' => 'AdminController@usersAdmin'));
Route::get('do/tokens/{id}', array('as' => 'do/token', 'uses' => 'AdminController@tokenEditAdmin'));



/**
 * Authentication
 */

Route::get ('/login', array('as' => 'login.get', 'uses' => 'SecurityController@loginAction'));
Route::post('/login', array('as' => 'login.post', 'before' => 'csrf', 'uses' => 'SecurityController@loginAttempt'));
Route::get ('/logout', array('as' => 'logout', 'uses' => 'SecurityController@logoutAction'));