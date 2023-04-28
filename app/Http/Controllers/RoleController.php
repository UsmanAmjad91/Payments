<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mockery\Expectation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Toastr;
use Exception;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        // set permission
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','show','view','list']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy','delete']]);
    }
    public function index(Request $request){
        $data = [];
        $data['title'] = "Roles";
        $data['roles'] = Role::all();
        return view('roles.roles',$data);
    }

    public function add(Request $request){
        $data = [];
        $data['title'] = "Add Roles";
        $data['permissions'] = Permission::all();
        return view('roles.add',$data);

       }
       public function create(Request $request){

        // dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        // $role->syncPermissions($request->input('permissions'));
        $role->syncPermissions($request->permissions);
        if($role){
            toastr()->success('Successfully Added Role');
            return Redirect::to(route('role.show'));
        }else{
         toastr()->error('Some Thing Wrong');
          return back();
        }
       }

       public function edit(Request $request,$id){
        $data = [];
        $data['role'] = Role::find($id);
        $data['title'] = "Update Roles";
        $data['permissions'] = Permission::all();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('roles.edit',$data);

       }

       public function update(Request $request,$id){
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',Rule::unique('roles')->ignore($id),
            'permissions' => 'required',
        ]);

            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->permissions);

            if($role){
                toastr()->success('Successfully Update Role');
                return Redirect::to(route('role.show'));
            }else{
            toastr()->error('Some Thing Wrong');
            return back();
            }

       }

       public function destroy(Request $request,$id){
        if(!empty($id)){
            $delete = Role::where('id', $id)->delete();
        }
        if($delete){
            toastr()->success('Successfully Delete Permission');
            return Redirect::to(route('role.show'));
        }else{
         toastr()->error('Some-Thing Wrong');
          return back();
        }

       }



}
