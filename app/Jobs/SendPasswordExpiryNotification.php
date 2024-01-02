<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Mail\PasswordExpiryNotification;
use Illuminate\Support\Facades\Mail;

class SendPasswordExpiryNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userObj;
    protected $messageObj;

    public function __construct(User $userObj, $messageObj)
    {
        $this->userObj = $userObj;
        $this->messageObj = $messageObj;
    }

    public function handle()
    {
        Mail::to($this->userObj->email)->send(new PasswordExpiryNotification($this->userObj, $this->messageObj));
    }
}
