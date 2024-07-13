<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class AttributeValueController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    //  attribute values
    public function attributeValues($attribute_id){
        if (is_null($this->user) || !$this->user->can('attributes.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['attribute'] = Attribute::with('attributeValues')->findOrFail($attribute_id)->toArray();
        return view('admin.attributes-value.index', $data);
    }

    //  store
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('attributes.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        $attributeValue = new AttributeValue();
        $requested_data = $request->all();
        if (isset($request->status)) {
            $attributeValue->status = 1;
        }
        else{
            $attributeValue->status = 0;
        }
        $save = $attributeValue->fill($requested_data)->save();
        return redirect()->back()->with('success','Attribute value successfully created!');
    } 

    public function show($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $attributeValue,
        ]);
    }

    public function update(Request $request) {
        if (is_null($this->user) || !$this->user->can('attributes.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }

        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        $attributeValue = AttributeValue::findOrFail($request->id);
        $requested_data = $request->all();
        if (isset($request->status)) {
            $attributeValue->status = 1;
        }
        else{
            $attributeValue->status = 0;
        }
        $save = $attributeValue->fill($requested_data)->save();
        return redirect()->back()->with('success','Attribute value successfully updated!');
    }    
    
    //  delete
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('attributes.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        AttributeValue::findOrFail($id)->update(['is_deleted' => 1]);
        return redirect()->back()->with('success', 'Attribute value successfully deleted!');
    }

    //  changeStatus
    public function changeStatus($id) {
        if (is_null($this->user) || !$this->user->can('attributes.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $attributeValue = AttributeValue::findOrFail($id);

        // Update the status
        $attributeValue->status = $attributeValue->status == 1 ? 0 : 1;
        $attributeValue->save();
        return redirect()->back()->with('success', 'Attributes value status successfully updated!');
    }

}
