<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
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
        if (is_null($this->user) || !$this->user->can('colors.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $all_data = Color::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('admin.colors.colors-list', compact('all_data'));
    }

    //  store
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('colors.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
            'code' =>'required|string|max:255',
        ]);

        $color = new Color();
        $requested_data = $request->all();
        if (isset($request->status)) {
            $color->status = 1;
        }
        else{
            $color->status = 0;
        }
        $save = $color->fill($requested_data)->save();
        return redirect()->back()->with('success','Color successfully created!');
    }    

    public function show($id)
    {
        $color = Color::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $color,
        ]);
    }

    public function updateColors(Request $request) {
        if (is_null($this->user) || !$this->user->can('colors.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
            'code' =>'required|string|max:255',
        ]);

        $color = Color::findOrFail($request->id);
        $requested_data = $request->all();
        if (isset($request->status)) {
            $color->status = 1;
        }
        else{
            $color->status = 0;
        }
        $save = $color->fill($requested_data)->save();
        return redirect()->back()->with('success','Color successfully updated!');
    }

    //  delete
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('colors.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        Color::findOrFail($id)->update(['is_deleted' => 1]);
        return redirect()->back()->with('success', 'Color successfully deleted!');
    }

    //  changeStatus
    public function changeStatus($id) {
        if (is_null($this->user) || !$this->user->can('colors.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $color = Color::findOrFail($id);
        $color->status = $color->status == 1 ? 0 : 1;
        $color->save();
        return redirect()->back()->with('success', 'Colors status successfully updated!');
    }
}
