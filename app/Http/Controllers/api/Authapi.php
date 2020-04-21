<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class Authapi extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // return $user->createToken("yeye")->plainTextToken;
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'device_name' => 'required'
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role_enduser = new Role(["role" => "enduser"]);
        $created = $user->roles()->saveMany([$role_enduser]);
        

        if ($created) {
            $token = $user->createToken($request->device_name)->plainTextToken;
            $json_re = [
                "token" => $token,
                "msg" => "user created",
                "error" => null,
            ];
        } else {
            $json_re = [
                "token" => null,
                "msg" => "user created fail",
                "error" => true,
            ];
        }
        $user->sendEmailVerificationNotification();

        return response()->json($json_re);
    }
}
