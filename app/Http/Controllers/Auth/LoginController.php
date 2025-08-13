<?php

namespace App\Http\Controllers\Auth;

// 1. PASTIKAN BARIS INI ADA
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// 2. PASTIKAN ADA 'extends Controller'
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
