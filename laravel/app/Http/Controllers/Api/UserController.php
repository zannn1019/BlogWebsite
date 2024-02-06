<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API_TOKEN')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

    public function register(Request $request)
    {
        if (User::where("email", "=", $request['email'])->count()) {
            return response()->json([
                "success" => false,
                "message" => "The email address already used!"
            ], 200);
        }

        //? Validasi request dari user
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ]);

        //? Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Something wrong",
                "data" => $validator->errors()
            ], 200);
        }

        //? Jika validasi berhasil
        $input = $request->only(['name', 'email', 'password']);
        $user = User::create($input);
        $token = $user->createToken('API_TOKEN')->accessToken;

        //? Response
        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'api_token' => $token
        ], 201);
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
