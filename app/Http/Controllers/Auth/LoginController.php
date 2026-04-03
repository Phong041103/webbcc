<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // ✅ THÊM ĐOẠN NÀY
    protected function authenticated($request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('admin');
        }

        return redirect('/');
    }
}