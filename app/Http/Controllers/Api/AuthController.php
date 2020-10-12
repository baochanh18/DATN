<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        else
        {
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);


            $profile = $request->get('profile');
            $profile['birthday'] = Carbon::parse($profile['birthday'])->format('Y-m-d');
            error_log($profile['birthday']);
            $user->user_profile()->create($profile);

            $token = auth()->login($user);
            return response()->success(["token" => $token], ["Register Success"], 201);
        }
    }

    public function login(LoginRequest $request){
        if ($request->validator->fails()) {
            return response()->error($request->validator->errors()->all());
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
