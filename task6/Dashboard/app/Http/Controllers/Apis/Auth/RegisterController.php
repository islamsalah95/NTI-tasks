<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\traits\ApiTrait;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->only('name','email','device_type');
        $data['password'] = Hash::make($request->password);
        $admin = Admin::create($data);
        $token =  $admin->createToken($request->device_type)->plainTextToken;
        $admin->token = 'Bearer '.$token;
        return ApiTrait::data(compact('admin'));
    }
}
