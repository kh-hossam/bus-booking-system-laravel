<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Libraries\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class PassengerAuthController extends Controller
{
    public function register(Request $request){

        $user = User::where('email', $request->email)->first();
        if($user){
            return ApiResponse::fail([], 'Email already exists', Response::HTTP_NOT_FOUND);
        }

        $validatedFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $validatedFields['name'],
            'email' => $validatedFields['email'],
            'password' => bcrypt($validatedFields['password']),
            'is_admin' => false,
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => UserResource::make($user),
            'token' => $token
        ];

        return ApiResponse::success($response, '', Response::HTTP_CREATED);
    }


    public function login(Request $request){

        $validatedFields = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $validatedFields['email'])->first();

        if(!$user || !Hash::check($validatedFields['password'], $user->password)){
            return ApiResponse::fail([], 'Wrong credentials', Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        $response = [
            'user' => UserResource::make($user),
            'token' => $token
        ];

        return ApiResponse::success($response, 'Logged in successfully');
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return ApiResponse::success([], 'Logged out');
    }
}
