<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /**
     * Display the reset password form.
     */
    public function create(Request $request, $token)
    {
        // Validate token exists and not expired (1 hour)
        $resetToken = DB::table('password_reset_tokens')
            ->where('created_at', '>', now()->subHour())
            ->get();

        $validToken = null;
        foreach ($resetToken as $record) {
            if (Hash::check($token, $record->token)) {
                $validToken = $record;
                break;
            }
        }

        if (!$validToken) {
            return redirect()->route('login')
                ->with('error', 'Link reset password tidak valid atau sudah kadaluarsa.');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $validToken->email
        ]);
    }

    /**
     * Handle the password reset.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Validate token
        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('created_at', '>', now()->subHour())
            ->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return back()->withErrors([
                'token' => 'Token reset password tidak valid atau sudah kadaluarsa.'
            ]);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}
