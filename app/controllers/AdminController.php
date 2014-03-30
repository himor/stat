<?php

class AdminController extends BaseController {

    protected $layout = 'layout.admin';

    /**
     * Initial page
     *
     * @return mixed
     */
    public function showAdmin()
    {
        return Redirect::to('do/tokens');

    }

    /**
     * Display all tokens
     *
     * @return mixed
     */
    public function tokensAdmin()
    {
        $tokens = Tokens::all();

        return View::make('admin.display', array('tokens' => $tokens));
    }

    /**
     * Edit single token
     *
     * @param $id
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

        return View::make('admin.users', array('users' => $users));
    }

}
