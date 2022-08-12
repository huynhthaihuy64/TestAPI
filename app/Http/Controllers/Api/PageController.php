<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('home', [
            'title' => "Home Page",
        ]);
    }

    public function login()
    {
        return view('login', [
            'title' => "Login Page",
        ]);
    }

    public function register()
    {
        return view('register', [
            'title' => "Register Page",
        ]);
    }

    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => "1"])) {

            return redirect()->route('index');
        }
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => "0"])) {

            return redirect()->route('admins.index');
        } else {
            Session::flash('error', 'Password is incorrect');
            return redirect()->back();
        }
    }

    public function store(RegisterRequest $request)
    {
        User::create($request->all(), with($request->role == 1));
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function forgot()
    {
        return view('forgot_password', [
            'title' => "Forgot Password",
        ]);
    }

    public function postForgot(ForgotRequest $request)
    {
        $data = $this->authService->postForgot($request);
        Session::flash('success', 'We have e-mailed your password reset link!');
        return redirect()->back();
    }

    public function getPassword($token)
    {
        return view('reset_password', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $this->authService->updatePassword($request);
        Session::flash('success', 'Your password has been changed!');
        return redirect()->route('login');
    }
}
