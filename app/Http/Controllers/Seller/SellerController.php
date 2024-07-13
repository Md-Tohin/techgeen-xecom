<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    //  dashboard
    public function index()
    {
        return view('seller.dashboard');
    }
}
