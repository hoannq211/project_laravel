<?php

namespace App\Jobs;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // \Log::info('Bắt đầu xử lý job gửi email xác minh cho user: ' . $this->user->email);
            Mail::to($this->user->email)->send(new VerifyEmail($this->user));
            // \Log::info('Đã gửi email xác minh cho user: ' . $this->user->email);
        } catch (\Throwable $e) {

            log::error('Gửi email xác minh thất bại: ' . $e->getMessage());
            throw $e;
        }
    }
}
