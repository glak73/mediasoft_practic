<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        if ($role === 'super_admin') {
            $users = User::all();
            return view('dashboard', compact('users'));
        } elseif ($role === 'admin') {
            $users = User::where('role', '=', 'user')->get();
            return view('dashboard', compact('users'));
        } else {
            return view('dashboard');
        }

        return view('dashboard', compact('users'));
    }
}
