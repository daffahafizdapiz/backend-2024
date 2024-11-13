<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Membuat fitur register
    public function register(Request $request) {
        //Menangkap Inputan
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        //Menginsert data ke table user 
        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully'
        ];

        //Mengirim response JSON
        return response()->json($data, 200);
    }

    //Membuat fitur Login
    public function login(Request $request) {
        //Menangkap input user
        $input = [
            'email' => $request->email,
            'password' => $request->password 
        ];
        //Melakukan autentikasi

        if (Auth::attempt($input)) {
            //Membuat token
            $token = Auth::user()->createToken('auth_token');
            $data = [
                'message' => 'Login Successfully',
                'token' => $token->plainTextToken
            ];
            //Mengembalikan response JSON
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Username or Password is wrong'
            ];
            return response()->json($data, 401);
        }

    }
    
}
