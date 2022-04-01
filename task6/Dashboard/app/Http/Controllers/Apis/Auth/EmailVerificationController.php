<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\Admin;
use App\traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCodeRequest;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function send(Request $request)
    {
        $token = $request->header('Authorization');
        $authenticatedAdmin = Auth::guard('sanctum')->user();
        // send mail
        $code = rand(10000,99999);
        $admin = Admin::find($authenticatedAdmin->id);
        $admin->code = $code;
        $admin->save();
        $admin->token = $token;
        return ApiTrait::data(compact('admin'));
    }

    public function verify(CheckCodeRequest $request)
    {
        $token = $request->header('Authorization');
        $authenticatedAdmin = Auth::guard('sanctum')->user();
        $admin = Admin::find($authenticatedAdmin->id);
        if($admin->code == $request->code){
            $admin->email_verified_at = date('Y-m-d H:i:s');
            $admin->save();
            $admin->token = $token;
            return ApiTrait::data(compact('admin'),"Correct Code",200);
        }else{
            $admin->token = $token;
            return ApiTrait::data(compact('admin'),"Wrong Code",422);
        }
    }
}
