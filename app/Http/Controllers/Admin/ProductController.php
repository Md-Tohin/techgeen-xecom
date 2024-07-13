<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    //  index 
    public function index(){
        if (is_null($this->user) || !$this->user->can('products.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['products'] = Product::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        
        return view('admin.products.products-list', $data);
    }

    //  create 
    public function create(){
        if (is_null($this->user) || !$this->user->can('products.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['colors'] = Color::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $data['brands'] = Brand::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('admin.products.products-create', $data);
    }
}
