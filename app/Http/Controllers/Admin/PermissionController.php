<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function index(){
        if(Auth::check())
        {
            $permission = Permission::with('roles')->get();
            return view('admin.permission', compact('permission'));
        }
        return redirect()->route('login')
            ->withErrors([
                'username' => 'Vui lòng đăng nhập',
            ])->onlyInput('username');
    }
}
