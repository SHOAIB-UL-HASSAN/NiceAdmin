<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
class UserController extends Controller
{
    public function UserCreate(UserRequest $request){
        $user['password'] = Hash::make($request->password);
        $user=User::create($request->validated());
            //generate token
            $token = $user->createToken('my_Token')->plainTextToken;
            $response = [
                'data' => $user,
                'token' => $token,
            ];
            //response expected
            return response()->json($response, 200);
    }
        //login
    public function login(Request $request)
    {
            //validate request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => 'The provided credentials are incorrect.'
                ], 401);
            }
            //generate token
            $token = $user->createToken('mytoken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            //expected response
            return response()->json($response, 200);
    }
    //user can logout through this method
    public function logout(Request $request)
    {
           $token = request()->user()->currentAccessToken()->token;
            $request->user()->tokens()->where('token', $token)->delete();
            // expected response
            return response([
                'message' => 'Logged Out Succefully!!'], 200);
}

}