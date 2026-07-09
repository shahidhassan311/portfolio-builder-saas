<?php

namespace App\Jobs;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // <-- Add this
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $otp,
    ) {}

    public function handle(): void
    {
        try{
            Mail::to($this->user->email)
            ->send(new SendOtpMail($this->otp));
        }catch (Throwable $e) {
            Log::error('OTP mail failed', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage(),
            ]);

        }

    }
}
