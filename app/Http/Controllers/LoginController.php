<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return auth()->user()->createToken('key')->plainTextToken;
        }
        return 'no . you dont have access';
    }

}
