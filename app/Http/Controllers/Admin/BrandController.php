<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('brand.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['brands'] = Brand::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('admin.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('brand.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('brand.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $request->validate([
            'name' =>'required|string|max:255',
            'logo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request['slug']) {
            $request['slug'] = $request['slug'];
        }
        else {            
            $request['slug'] = Str::slug($request['name']);
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/brands/'), $image_name);
            $logo_path = 'assets/common/upload/images/brands/' . $image_name;
        } else {
            $logo_path = '';
        }

        $brand = new Brand();
        $requested_data = $request->all();
        $brand->logo = $logo_path;
        $save = $brand->fill($requested_data)->save();

        return redirect()->route('brands.index')->with('success', 'Brand successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['brand'] = Brand::findOrFail($id);
        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $request->validate([
            'name' =>'required|string|max:255',
            'logo' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request['slug']) {
            $request['slug'] = $request['slug'];
        }
        else {            
            $request['slug'] = Str::slug($request['name']);
        }

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/brands/'), $image_name);
            $logo_path = 'assets/common/upload/images/brands/' . $image_name;
            @unlink($request->old_logo);
        } else {
            $logo_path = $request->old_logo;
        }
        
        $brand = Brand::findOrFail($id);
        $requested_data = $request->all();
        $brand->logo = $logo_path;
        $save = $brand->fill($requested_data)->save();
        return redirect()->route('brands.index')->with('success', 'Brand successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('brand.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        Brand::findOrFail($id)->update(['is_deleted' => 1]);
        return redirect()->route('brands.index')->with('success', 'Brand successfully deleted!');
    }

    //  changeStatus
    public function changeStatus($id) {
        if (is_null($this->user) || !$this->user->can('brand.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $brand = Brand::findOrFail($id);

        // Update the status
        $brand->status = $brand->status == 1 ? 0 : 1;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand status successfully updated!');
    }
}
