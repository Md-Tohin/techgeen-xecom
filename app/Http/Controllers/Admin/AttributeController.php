<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
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
        if (is_null($this->user) || !$this->user->can('attributes.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $all_data = Attribute::with('attributeValues')->where('is_deleted', 0)->orderBy('id', 'desc')->get();
        return view('admin.attributes.attributes-list', compact('all_data'));
    }

    //  store
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('attributes.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        $attribute = new Attribute();
        $requested_data = $request->all();
        if (isset($request->status)) {
            $attribute->status = 1;
        }
        else{
            $attribute->status = 0;
        }
        $save = $attribute->fill($requested_data)->save();

        if ($save) {
            $attributeValues = json_decode($request->input('attribute_values'), true);

            foreach ($attributeValues as $value) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'name' => $value['value'],
                    'is_deleted' => 0,
                ]);
            }
        }

        return redirect()->back()->with('success','Attribute successfully created!');
    }    

    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $attribute,
        ]);
    }

    public function updateAttributes(Request $request) {
        if (is_null($this->user) || !$this->user->can('attributes.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        $attribute = Attribute::findOrFail($request->id);
        $requested_data = $request->all();
        if (isset($request->status)) {
            $attribute->status = 1;
        }
        else{
            $attribute->status = 0;
        }
        $save = $attribute->fill($requested_data)->save();
        return redirect()->back()->with('success','Attribute successfully updated!');
    }

    //  delete
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('attributes.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        Attribute::findOrFail($id)->update(['is_deleted' => 1]);
        return redirect()->route('attributes.index')->with('success', 'Attribute successfully deleted!');
    }

    //  changeStatus
    public function changeStatus($id) {
        if (is_null($this->user) || !$this->user->can('attributes.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $attribute = Attribute::findOrFail($id);

        // Update the status
        $attribute->status = $attribute->status == 1 ? 0 : 1;
        $attribute->save();
        return redirect()->route('attributes.index')->with('success', 'Attributes status successfully updated!');
    }
}
