<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('category.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['categories'] = Category::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('category.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('category.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
            'icon' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request['slug']) {
            $request['slug'] = $request['slug'];
        }
        else {            
            $request['slug'] = Str::slug($request['name']);
        }

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $icon_path = 'assets/common/upload/images/categories/' . $image_name;
        } else {
            $icon_path = '';
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $cover_image_path = 'assets/common/upload/images/categories/' . $image_name;
        } else {
            $cover_image_path = '';
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $banner_path = 'assets/common/upload/images/categories/' . $image_name;
        } else {
            $banner_path = '';
        }

        $category = new Category();
        $requested_data = $request->all();
        $category->icon = $icon_path;
        $category->cover_image = $cover_image_path;
        $category->banner = $banner_path;
        $save = $category->fill($requested_data)->save();

        return redirect()->route('categories.index')->with('success', 'Category successfully created!');
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
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['category'] = Category::findOrFail($id);
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $request->validate([
            'name' =>'required|string|max:255',
            'icon' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $icon_path = 'assets/common/upload/images/categories/' . $image_name;
            @unlink($request->old_icon);
        } else {
            $logo_path = $request->old_icon;
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $cover_image_path = 'assets/common/upload/images/categories/' . $image_name;
            @unlink($request->old_cover_image);
        } else {
            $logo_path = $request->old_cover_image;
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/categories/'), $image_name);
            $banner_path = 'assets/common/upload/images/categories/' . $image_name;
            @unlink($request->old_banner);
        } else {
            $logo_path = $request->old_banner;
        }

        $category = Category::findOrFail($id);
        $requested_data = $request->all();
        $category->icon = $icon_path;
        $category->cover_image = $cover_image_path;
        $category->banner = $banner_path;
        $save = $category->fill($requested_data)->save();

        return redirect()->route('categories.index')->with('success', 'Category successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('category.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        Category::findOrFail($id)->update(['is_deleted' => 1]);
        return redirect()->back()->with('success', 'Category successfully deleted!');
    }

    //  changeStatus
    public function changeStatus($id) {
        if (is_null($this->user) || !$this->user->can('category.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $category = Category::findOrFail($id);

        // Update the status
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();
        return redirect()->back()->with('success', 'Category status successfully updated!');
    }

     //  Append Categories Level By Ajax
     public function appendCategoriesLevel(Request $request){       
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subCategories')->where(['parent_id'=>0, 'category_type'=>$data['category_type']])->get()->toArray();
            return view('admin.category.append_categories_level')->with(compact('getCategories'));
        }
    }
}
