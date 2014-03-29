<?php

class SecurityController extends BaseController {

    protected $layout = 'layout.security';

    /**
     * Open login page
     */
    public function loginAction()
    {
        return View::make('security.login');
    }

    /**
     * Trying to log in
     */
    public function loginAttempt()
    {
        $email = Input::get('email', null);
        $passw = Input::get('password', null);

        $validation = Validator::make(Input::all(), User::$rules);
        if (!$validation->passes()) {
            return Redirect::route('login.get')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'There were validation errors.');
        }

        if (Auth::attempt(array('email' => $email, 'password' => $passw, 'blocked' => false))) {
            return Redirect::intended('do');
        } else {
            return Redirect::route('login.get')
                ->withInput()
                ->withErrors($validation)
                ->with('message', 'Authentication error.');
        }
    }

    /**
     * Log out
     */
    public function logoutAction()
    {
        Auth::logout();
        return Redirect::route('root');
    }



}