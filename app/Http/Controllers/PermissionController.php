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

class PermissionController extends Controller
{
    public function __construct()
    {
        // set permission
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show','view','list']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy','delete']]);
    }

   public function index(Request $request){
    $data = [];
    $data['title'] = "Permissions";
    $data['permissions'] = Permission::all();
    return view('permissions.permissions',$data);
   }
   public function add(Request $request){
    $data = [];
    $data['title'] = "Add Permissions";
    return view('permissions.add',$data);

   }
   public function create(Request $request){

    $this->validate($request, [
        'name' => 'required|unique:permissions',
    ]);

    $permission = Permission::create(['name' => $request->input('name'),'guard_name' => 'web']);
    if($permission){
        toastr()->success('Successfully Added Permission');
        return Redirect::to(route('permission.show'));
    }else{
     toastr()->error('Some Thing Wrong');
      return back();
    }
   }

   public function edit(Request $request,$id){
    // dd($id);
    $data = [];
    $data['title'] = "Edit Permissions";
    $data['permission'] = Permission::find($id);
    return view('permissions.edit',$data);

   }

   public function update(Request $request,$id){
    // dd($request->all());
    $validator = Validator::make($request->all(), [
        'name' => 'required',Rule::unique('permissions')->ignore($id),
    ]);

    if ($validator->fails()) {
        toastr()->error(json_encode($validator->errors()->all()));
        return back();
    }

    $permission = Permission::find($id);
    $permission->name = $request->input('name');
    $permission->save();

    if($permission){
        toastr()->success('Successfully Update Permission');
        return Redirect::to(route('permission.show'));
    }else{
     toastr()->error('Some-Thing Wrong');
      return back();
    }
   }


   public function destroy(Request $request,$id){
    if(!empty($id)){
        $delete = Permission::where('id', $id)->delete();
    }
    if($delete){
        toastr()->success('Successfully Delete Permission');
        return Redirect::to(route('permission.show'));
    }else{
     toastr()->error('Some-Thing Wrong');
      return back();
    }

   }


}
