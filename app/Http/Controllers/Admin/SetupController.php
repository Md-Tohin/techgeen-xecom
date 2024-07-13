<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Models\WebsiteGeneralSetting;
use App\Models\WebsiteSeoSetting;
use Carbon\Carbon;

class SetupController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    // General Setting View
    public function generalSetting(){
        if (is_null($this->user) || !$this->user->can('role.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data = WebsiteGeneralSetting::first();
        $seoInfo = WebsiteSeoSetting::first();
        return view('admin.setup.general_setting', compact('data', 'seoInfo'));
    }

    // General Setting Store
    public function generalSettingStore(Request $request){
        if (is_null($this->user) || !$this->user->can('Website Setup.General Settings Edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $validatedData = $request->validate([
            'name' => 'required',
            // 'email' => 'required',
            // 'url' => 'required',
            // 'phone' => 'required',
            // 'address' => 'required',
            // 'logo' => 'required',
            // 'favicon' => 'required',
        ]);
        $data = WebsiteGeneralSetting::first();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name_gen = uniqid();
            $img_ex = $image->getClientOriginalExtension();
            $image_name = $name_gen . '.' . $img_ex;
            $image->move(public_path('assets/common/upload/images/'), $image_name);
            $logo_path = 'assets/common/upload/images/' . $image_name;
            @unlink($data->logo);
        } else {
            $logo_path = $data->logo;
        }
        // dd($image_name);

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');     
            $favicon_name_gen = uniqid();       
            $favicon_ex = $favicon->getClientOriginalExtension();
            $favicon_name = $favicon_name_gen.'.'.$favicon_ex;
            $favicon->move('assets/common/upload/images/', $favicon_name);
            $favicon_path = 'assets/common/upload/images/'.$favicon_name;
            @unlink($data->favicon);
        }
        else{
            $favicon_path = $data->favicon;
        }
        
        WebsiteGeneralSetting::findOrFail($data->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'url' => $request->url,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $logo_path,
            'favicon' => $favicon_path,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success', 'Website general setting successfully updated!');
    }

    //  seoSettingStore
    public function seoSettingStore(Request $request){
        $request->validate([
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'google_analytics' => 'required',
        ]);
        $data = WebsiteSeoSetting::first();
        WebsiteSeoSetting::findOrFail($data->id)->update([
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'google_analytics' => $request->google_analytics,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('success', 'Website seo setting successfully updated!');

    }
}
