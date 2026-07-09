<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendOtpJob;
use App\Models\EmailOtp;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class SendRegistrationOtpListener
{
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;

        $otp = (string) random_int(100000, 999999);

        EmailOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp'        => $otp,
                'expires_at' => now()->addSeconds(60),
            ]
        );

        SendOtpJob::dispatch($user, $otp);
    }

    public function middleware(): array
    {
        return [
            new WithoutOverlapping('otp-user-' . $event->user->id)
        ];
    }
}
