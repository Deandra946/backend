<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Dotenv\Exception\ValidationException;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            "email"=> "required|email|exists:users,email",
            "password"=> "required|min:5",
        ]);

        $user = User::where("email", $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationValidationException::withMessages([
                "message" => "Email or password incorrect"
            ]);
        }

        $token = $user->createToken($user->name)->plainTextToken;
        return response()->json([
            "message" => "Login success",
            "user" => $user,
            "token" => $token
        ]);
    }

    public function logout(Request $request){
        if(!Auth::check()){
            return response()->json([
                "message" => "Unauthenticated"
            ]);
        }

        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logout success"
        ]);
    }
}
