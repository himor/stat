<?php

/**
 * Open routes
 */

Route::pattern('id', '[0-9]+');

Route::get('/', array(
    'as'   => 'root',
    'uses' => 'IndexController@showIndex'
    )
);

/**
 * Administering
 */

Route::when('do/*', 'auth');
Route::get('do', array(
    'as'     => 'do',
    'before' => 'auth',
    'uses'   => 'AdminController@showAdmin'
    )
);
Route::get('do/tokens', array(
    'as'   => 'do/tokens',
    'uses' => 'AdminController@tokensAdmin'
    )
);
Route::get('do/tokens/{id}', array(
        'as'     => 'do/token',
        'uses'   => 'AdminController@tokenEditAdmin'
    )
);
Route::get('do/tokens/new', array(
        'as'     => 'do/new.token',
        'uses'   => 'AdminController@tokenNewAdmin'
    )
);
Route::post('do/tokens/{id}', array(
        'as'     => 'do/token',
        'before' => 'csrf',
        'uses'   => 'AdminController@tokenEditAdmin'
    )
);
Route::post('do/tokens/new', array(
        'as'     => 'do/new.token',
        'before' => 'csrf',
        'uses'   => 'AdminController@tokenNewAdmin'
    )
);

Route::get('do/users', array(
    'as'   => 'do/users',
    'uses' => 'AdminController@usersAdmin'
    )
);
Route::get('do/users/{id}', array(
        'as'     => 'do/user',
        'uses'   => 'AdminController@usersEditAdmin'
    )
);
Route::get('do/users/new', array(
        'as'     => 'do/new.user',
        'uses'   => 'AdminController@userNewAdmin'
    )
);
Route::post('do/users/{id}', array(
        'as'     => 'do/user',
        'before' => 'csrf',
        'uses'   => 'AdminController@usersEditAdmin'
    )
);
Route::post('do/users/new', array(
        'as'     => 'do/new.user',
        'before' => 'csrf',
        'uses'   => 'AdminController@userNewAdmin'
    )
);

/**
 * Authentication
 */

Route::get ('/login', array(
    'as'   => 'login.get',
    'uses' => 'SecurityController@loginAction'
    )
);
Route::post('/login', array(
    'as'     => 'login.post',
    'before' => 'csrf',
    'uses'   => 'SecurityController@loginAttempt'
    )
);
Route::get ('/logout', array(
    'as'   => 'logout',
    'uses' => 'SecurityController@logoutAction'
    )
);