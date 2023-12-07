<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable = [
        'id',
        'permission_name',
        'permission_description'
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class,'permission_roles');
    }
}
