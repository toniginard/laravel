<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;
use Krenor\LdapAuth\Objects\LdapUser;

class AuthController extends Controller
{
    /**
     * the model instance
     *
     * @var User
     */
    protected $user;

    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @param Authenticator|Guard $auth
     * @param LdapUser $user
     */
    public function __construct(Guard $auth, LdapUser $user)
    {
        $this->auth = $auth;
        $this->user = $user;
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     *
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {
        if ( $this->auth->attempt( $request->only('username', 'password') ) ) {
            // Redirect to indented page or fall back to index page
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors(
            'Username and/or Password are not matching!'
        );
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }
}