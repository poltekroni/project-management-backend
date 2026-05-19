<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authcontroller extends Controller
{
    // registration API
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()){
            return response()->json([
                'masage' => $validator->errors()
            ], 400);
        }

        $user = User::create($request->all());

        $token = $user->createtoken('auth_token')->plainTextToken;

        return response()->json([
            'massage' => 'user registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
        
    }

    // login API
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json([
                'masage' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'massage' => "invalid login credentials"
            ], 201);
        }

        $token = $user->createtoken('auth_token')->plainTextToken;


        return response()->json([
            'massage' => 'login seccessfull',
            'user' => $user,
            'token' => $token
        , 200]);


    }

    // logout API
    public function logout(Request $request){
        //revoke the token that was used to authenticate the request
        $user = Auth::user();
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'massage' =>'logged out Successfully'
        ], 200);
    }
}
