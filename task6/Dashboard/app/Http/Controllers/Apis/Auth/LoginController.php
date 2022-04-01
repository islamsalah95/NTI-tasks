<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\Admin;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $admin = Admin::firstWhere('email',$request->email);
        if(! Hash::check($request->password,$admin->password)){
            return ApiTrait::errorMessage(['email'=>__('messages.auth.wrong email or password')],__('messages.auth.failed attempt'),401);
        }
        $token = 'Bearer '. $admin->createToken($request->device_type)->plainTextToken;
        $admin->token = $token;
        if(is_null($admin->email_verified_at)){
            return ApiTrait::data(compact('admin'),"Admin Not Verified",401);
        }

        return ApiTrait::data(compact('admin'),"Admin Verified",200);
    }

    public function logoutAllDevices()
    {
        $admin = Auth::guard('sanctum')->user();
        $admin->tokens()->delete();
        return ApiTrait::successMessage("logged out successfully");
    }

    public function logout(Request $request)
    {
        $token = $request->header('authorization');
        $admin = Auth::guard('sanctum')->user();
        // $tokenId = $this->getTokenId($token);
        $admin->currentAccessToken()->delete();
        return ApiTrait::successMessage("logged out successfully");
    }

    // private function getTokenId(string $token){
    //     $expolededToken = explode('|',$token);
    //     $id = str_replace('Bearer ','',$expolededToken[0]);
    //     return $id;
    // }
}
