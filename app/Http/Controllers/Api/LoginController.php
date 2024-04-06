<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $userToken = auth()->user()->createToken('auth')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => 'Login Success',
                [
                    'token' => $userToken,
                ],
            ]);
        }
    }
}
