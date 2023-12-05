<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistPassword extends Model
{
    protected $table = 'blacklist_passwords';
    protected $fillable = ['blacklist_password'];
}
//php artisan tinker
//App\Models\BlacklistPassword::create([
//    'blacklist_password' => '123456@name',
//]);
//
//App\Models\BlacklistPassword::create([
//    'blacklist_password' => 'password@name',
//]);
//
//App\Models\BlacklistPassword::create([
//    'blacklist_password' => 'qwerty@name',
//]);
//
//App\Models\BlacklistPassword::create([
//    'blacklist_password' => 'abc123@name',
//]);

