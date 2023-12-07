<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index(){
        if(Auth::check())
        {
            $role = Role::with('users')->get();
            return view('admin.role', compact('role'));
        }
        return redirect()->route('login')
            ->withErrors([
                'username' => 'Vui lòng đăng nhập',
            ])->onlyInput('username');
    }
}
