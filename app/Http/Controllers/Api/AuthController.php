<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $message = [];

        $validator = Validator::make($request->all(), [
            'name' => 'required | max:255',
            'email' => 'required | unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], $message);

        if($validator->fails()){
            return response()->error($validator->errors()->all(), 422);
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = auth()->login($user);
            return response()->success(["token" => $token], ["Register Success"], 201);
        }
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->error($validator->errors()->all());
        }
        else
        {
            $credentials = $request->only(['email', 'password']);

            if(!$token = auth()->attempt($credentials)){
                return response()->error(["The email or password you have entered is wrong."]);
            }
            return response()->success(["token" => $token], ["Logged in successfully."]);
        }
    }
}
