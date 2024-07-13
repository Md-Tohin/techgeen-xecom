<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    //  login
    public function login()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    //  logout
    public function logout(Request $request)
	{
		Auth::guard('web')->logout();
		return redirect()->route('admin.login');
	}

    //  dashboard
    public function index()
    {
        return view('admin.dashboard');
    }    

    //  categories
    public function categories()
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        return view('admin.category.index');
    }
}
