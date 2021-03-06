<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\User as UserResource;

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
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);


            $profile = $request->get('profile');
            $profile['birthday'] = Carbon::parse($profile['birthday'])->format('Y-m-d');
            $uf = $user->userProfile()->create($profile);
            $uf->user()->save($user);
            $token = auth()->login($user);
            return response()->success(["token" => $token, "user" => new UserResource($user)], ["Register Success"], 201);
        }
    }

    public function company_register(CompanyRegisterRequest $request)
    {
        if($request->validator->fails()){
            return response()->error($request->validator->errors()->all(), 422);
        }
        else
        {

            $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 1,
            ]);


            $profile = $request->get('profile');
            $uf = $user->companyProfile()->create($profile);
            $uf->user()->save($user);
            $token = auth()->login($user);
            return response()->success(["token" => $token, "user" => new UserResource($user)], ["Register Success"], 201);
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

            $user = auth()->user();
            if(!$user->isActive)
                return response()->error(["Can not log in to this account!"],400);
            return response()->success(["token" => $token, "user" => new UserResource($user)], ["Logged in successfully."]);
        }
    }
}
