<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        if (is_null($this->user) || !$this->user->can('role.view')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $data['roles'] = Role::where('is_deleted', 0)->orderBy('id', 'asc')->get();
        return view('admin.role.index', $data);
    }

    //  getAll
    public function getAll(){        
        return response()->josn('test');
    }

    //  create
    public function create(){
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    //  store
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('role.create')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }   

        //Data Validation
        $request->validate([
            'name' => 'required | max:100 | unique:roles'
            ],
            [
                'name.unique' => 'Role name has already been taken!',
                'name.required' => 'Role name is required!',
            ]
        );

        $role = Role::create([ 'name' => $request->name, 'guard_name' => 'web' ]);
        $permissions = $request->permissions;
        if($permissions){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success', 'Role successfully created!');
    }

    //  edit
    public function edit($id){
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }  

        $data['role'] = Role::findOrFail($id);
        $data['permissions'] = Permission::all();
        return view('admin.role.edit', $data);
    }

    //  update
    public function update(Request $request, $id){
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        }  
        //Data Validation
        $request->validate([
            'name' => 'required | max:100 | unique:roles,name,' .$id
            ],
            [
                'name.unique' => 'Role name has already been taken!',
                'name.required' => 'Role name is required!',
            ]
        );
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        $permissions = $request->permissions;
        if($permissions){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index')->with('success', 'Role successfully updated!');
    }

    //  destroy
    public function destroy($id){
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            return redirect()->route('admin.dashboard')->with('failed', 'You don\'t have enough privileges to perform this action!');
        } 
        $role = Role::findById($id);
        if($role){
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role successfully deleted!');
        }else{
            return redirect()->route('roles.index')->with('error', 'Role can be deleted!');
        } 
    }
}
