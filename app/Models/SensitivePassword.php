<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensitivePassword extends Model
{
    protected $table = 'sensitive_passwords';
    protected $fillable = ['sensitive_password'];
}
