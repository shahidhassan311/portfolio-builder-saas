<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EmailOtp;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;

class OtpVerificationController extends Controller
{
    /**
     * OTP Page
     */
    public function create(User $user): View
    {
        return view('auth.verify-otp', compact('user'));
    }

    /**
     * Verify OTP
     */
        public function store(Request $request, User $user)
        {
            $request->validate([
                'otp' => ['required', 'digits:6'],
            ]);

            $emailOtp = EmailOtp::where('user_id', $user->id)->first();

            if (!$emailOtp) {
                return back()->withErrors([
                    'otp' => 'OTP not found.',
                ])->onlyInput('otp');
            }

            if (now()->greaterThan($emailOtp->expires_at)) {

                $emailOtp->delete();

                return back()->withErrors([
                    'otp' => 'OTP has expired. Please request a new one.',
                ])->onlyInput('otp');
            }

            if ($emailOtp->otp != $request->otp) {
                return back()->withErrors([
                    'otp' => 'Invalid OTP.',
                ])->onlyInput('otp');
            }

            $user->update([
                'email_verified_at' => now(),
                'is_verified'       => 1,
            ]);

            $emailOtp->delete();

            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', 'Email verified successfully.');
        }

    /**
     * Resend OTP
     */
    public function resend(User $user)
    {
        // Email already verified?
        if ($user->email_verified_at) {
            return redirect()->route('login')
                ->with('error', 'Email already verified.');
        }

        // Check existing OTP
        $emailOtp = EmailOtp::where('user_id', $user->id)->first();

        // Agar OTP abhi tak expire nahi hua
        if ($emailOtp && now()->lessThan($emailOtp->expires_at)) {

            $seconds = now()->diffInSeconds($emailOtp->expires_at);

            return back()->with(
                'error',
                "Please wait {$seconds} seconds before requesting a new OTP."
            );
        }

        // Purana OTP delete
        if ($emailOtp) {
            $emailOtp->delete();
        }

        // Naya OTP send
        event(new UserRegistered($user));

        return back()->with(
            'success',
            'A new OTP has been sent to your email.'
        );
    }
}
