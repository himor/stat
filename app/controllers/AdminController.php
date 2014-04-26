<?php

/**
 * Class AdminController
 * Does all the administrative actions
 * For example: creation of users or tokens
 * @author Mike Gordo <mgordo@live.com>
 */
class AdminController extends BaseController {

    protected $layout = 'layout.admin';

    /**
     * Initial page
     * Display list of tokens
     *
     * @return mixed
     */
    public function showAdmin()
    {
        return Redirect::to('do/tokens');

    }

    /**
     * Display all tokens as a list
     *
     * @return mixed
     */
    public function tokensAdmin()
    {
        $tokens = Tokens::all();

        return View::make('admin.display', ['tokens' => $tokens]);
    }

    /**
     * Create single token
     *
     * @return mixed
     */
    public function tokenNewAdmin()
    {
        $token = new Tokens();
        $token->value = $token->generateToken();

        $users  = User::where('blocked', false)->get();
        $users_ = [];

        foreach ($users as $user)
            $users_[$user->id] = $user->name . " (" . $user->email . ")";

        if (Request::isMethod('post')) {
            $rules = [
                'user_id' => 'required|numeric',
                'value'   => 'required|min:20'
            ];

            $validation = Validator::make(Input::all(), $rules);

            if (!$validation->passes()) {
                return Redirect::route('do/new.token')
                    ->withInput()
                    ->withErrors($validation)
                    ->with('message', 'There were validation errors.');
            }

            $token = Input::all();
            $token = array_merge($token, [
                'active'  => Input::get('active') ? true : false
            ]);

            Tokens::create($token);
            return Redirect::route('do/tokens');
        }

        return View::make('admin.new-token', [
            'token' => $token,
            'users' => $users_,
        ]);
    }

    /**
     * Edit single token
     *
     * @param integer $id Id of a token
     *
     * @return mixed
     */
    public function tokenEditAdmin($id)
    {
        $singleToken = Tokens::find($id);

        if (is_null($singleToken))
            return Redirect::route('do/tokens')
                ->with('error', 'Incorrect token id');
    }

    /**
     * Display all users
     *
     * @return mixed
     */
    public function usersAdmin()
    {
        $users = User::all();

        return View::make('admin.users', ['users' => $users]);
    }

    /**
     * Create new user
     * Basic validation + no duplicate emails
     *
     * @return mixed
     */
    public function userNewAdmin()
    {
        $user = new User();

        if (Request::isMethod('post')) {
            $rules = array_merge(User::$rules, ['name' => 'required']);

            $validation = Validator::make(Input::all(), $rules);

            if (!$validation->passes()) {
                return Redirect::route('do/new.user')
                    ->withInput()
                    ->withErrors($validation)
                    ->with('message', 'There were validation errors.');
            }

            if (count(User::where('email', strtoupper(Input::get('email')))->get())) {
                return Redirect::route('do/new.user')
                    ->withInput()
                    ->with('message', 'This email is already taken.');
            }

            $user = Input::all();
            $user = array_merge($user, [
                'password' => Hash::make(Input::get('password')),
                'blocked'  => Input::get('blocked') ? true : false
            ]);

            User::create($user);
            return Redirect::route('do/users');
        }

        return View::make('admin.new-user', ['user' => $user]);
    }

    /**
     * Edit users information
     *
     * @param integer $id Id of the user
     *
     * @return mixed
     */
    public function usersEditAdmin($id)
    {
        $singleUser = User::find($id);

        if (is_null($singleUser))
            return Redirect::route('do/users')
                ->with('error', 'Incorrect user id');

        if (Request::isMethod('post')) {
            $rules = array_merge(User::$rules, ['name' => 'required']);

            if (!(trim(Input::get('password'))))
                unset($rules['password']);

            $validation = Validator::make(Input::all(), $rules);

            if (!$validation->passes()) {
                return Redirect::route('do/user', $id)
                    ->withInput()
                    ->withErrors($validation)
                    ->with('message', 'There were validation errors.');
            }

            if (count(User::where('email', strtoupper(Input::get('email')))->
                where('id', '!=', $id)->get())) {
                return Redirect::route('do/user', $id)
                    ->withInput()
                    ->with('message', 'This email is already taken.');
            }

            $data = Input::all();
            if (!trim(Input::get('password')))
                unset ($data['password']);

            $singleUser->update($data);
            $singleUser->blocked = Input::get('blocked') ? true : false;

            if (trim(Input::get('password')))
                $singleUser->password = Hash::make(Input::get('password'));

            $singleUser->save();
            return Redirect::route('do/users');
        }

        return View::make('admin.edit-user', ['user' => $singleUser]);
    }

}
