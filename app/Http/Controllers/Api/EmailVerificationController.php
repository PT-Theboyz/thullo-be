<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
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

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'status' => false,
                'message' => "User Already Verified",
            ], 422);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'status' => false,
            'message'=>'Email has been verified'
        ], 200);
    }
}
