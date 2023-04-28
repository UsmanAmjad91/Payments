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
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function __construct()
    {
        // set permission
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show','view','list']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy','delete']]);
    }
    public function show(Request $request)
    {
        $data = [];
        $data['title'] = "User List";
        $data['users'] = User::orderBy('id','desc')->get();
        return view('auth.users',$data);
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect(route('auth.login'));
    }

    public function add(Request $request){
        $data = [];
        $data['title'] = "Add User";
        $data['roles'] = Role::all();
        return view('auth.adduser',$data);
    }

    public function create(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $user->assignRole($request->input('roles'));
        if($user){
            toastr()->success('Successfully Added User');
            return Redirect::to(route('users.show'));
        }else{
         toastr()->error('Some Thing Wrong');
          return back();
        }

    }

    public function edit(Request $request,$id){
        // Auth::user()->roles->pluck('id')
        $data = [];
        $data['title'] = "Update User";
        $data['user'] = User::find($id);
        $data['user_role'] = $data['user']->roles->pluck('id')->first();
        $data['roles'] = Role::all();
        return view('auth.edituser',$data);
    }

    public function update(Request $request,$id){
        //  dd($request->all());
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            unset($input['password']);
        }

        $user=User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        if($user){
            toastr()->success('Successfully Update User');
            return Redirect::to(route('users.show'));
        }else{
         toastr()->error('Some Thing Wrong');
          return back();
        }
    }

    public function destroy(Request $request,$id){
       $user = User::find($id)->delete();

        if($user){
            toastr()->success('Successfully Delete User');
            return Redirect::to(route('users.show'));
        }else{
         toastr()->error('Some Thing Wrong');
          return back();
        }
    }


}
