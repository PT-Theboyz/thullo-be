<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Contracts\Auth\Authenticatable;

class EmailVerificationController extends Controller
{
    public function __contrsuct()
    {
        $this->middleware('signed')->only('verify');
    }


    public function sendVerificationEmail(Request $request)
    {
        if($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => "User Already Verified",
            ], 422);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'status' => false,
            'message' => "Verification Link Sent",
        ], 200);
    }

    public function verify(Request $request)
    {
        auth()->loginUsingId($request->route('id'));
        
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => "User Already Verified",
            ], 422);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response([
            'status' => true,
            'message'=>'Email has been verified'
        ]);
    }
}
