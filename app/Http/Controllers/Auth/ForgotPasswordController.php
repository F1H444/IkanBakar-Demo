<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Display the forgot password form.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Generate and store reset token.
     */
    public function store(Request $request)
    {
        $request->merge([
            'email' => trim($request->email)
        ]);

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar dalam sistem kami.',
        ]);

        // Generate unique token
        $token = Str::random(64);

        // Delete old tokens for this email
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Store new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Get user name for email
        $user = User::where('email', $request->email)->first();

        // Return token and user info for EmailJS
        return response()->json([
            'success' => true,
            'message' => 'Link reset password akan dikirim ke email Anda.',
            'data' => [
                'token' => $token,
                'email' => $request->email,
                'name' => $user->name,
                'reset_url' => url('/reset-password/' . $token),
            ]
        ]);
    }
}
