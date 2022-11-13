<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
