<?php

namespace App\Console\Commands;

use App\Jobs\SendPasswordExpiryNotification;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CheckPasswordExpiry extends Command
{
    protected $signature = 'password:check-expiry';
    protected $description = ' Check password expiry and take actions if necessary';

    public function handle()
    {
        $users = User::where('is_blocked', false)->get();

        foreach ($users as $user) {
            $user->password_changed_at != null ?
                $expiryDate = Carbon::parse($user->password_changed_at)->addDays(12)
                :
                $expiryDate = Carbon::parse($user->created_at)->addDays(12);

            $daysRemaining = Carbon::now()->diffInDays($expiryDate, false);

            if ($daysRemaining <= 0) {
               $this->lockAccount($user);
            }
            if ($daysRemaining <= 7 && $daysRemaining > 0) {
                $this->sendNotification($user, 'Mật khẩu của bạn sắp hết thời hạn, hãy thay đổi mật khẩu trước khi tài khoản của bạn bị khóa.');
            }
        }
    }

    protected function sendNotification($user, $messageObj)
    {
        SendPasswordExpiryNotification::dispatch($user, $messageObj);
    }

    protected function lockAccount($user)
    {
        $user->update(['is_blocked' => true]);
        $user->save();
        $this->sendNotification($user, 'Tài khoản của bạn tạm thời bị khóa do mật khẩu không được cập nhật trong vòng 90 ngày.');
    }
}
