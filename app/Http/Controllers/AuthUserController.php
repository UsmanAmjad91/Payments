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
use Laravel\Socialite\Facades\Socialite;

class AuthUserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('frontuser');
        //  $this->middleware('frontusercheck');
    }

    public function login(Request $request)
    {
        $data = [];
        $data['title'] = "Login";
        return view('auth.login',$data);
    }
    public function sign_in(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Please Fill All Feilds');
            return back();
        }
        $credentials = $request->except(['_token']);
        // $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            toastr()->success('You Successfully Login');
            return redirect(route('payment'));
        }

        toastr()->error('You have Insert wrong Credentials');
          return back();

    }


    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
         $role = Role::where('name','user')->first();
        $user->assignRole($role->id);
        if($user){
            toastr()->success('Successfully Added User');
            return Redirect::to(route('users.show'));
        }else{
         toastr()->error('Some Thing Wrong');
          return back();
        }

    }
    protected function _registerOrLoginUser($data){
        // dd($data);
        $user = User::where('email',$data->email)->first();
          if(!$user){
             $user = new User();
             $user->name = $data->name;
             $user->email = $data->email;
             $user->provider_id = $data->id;
             $user->avatar = $data->avatar;
             $user->password = Hash::make($data->id);
             $user->login_with = $data->login_with;
             $user->save();
             $role = Role::where('name','user')->first();
             $user->assignRole($role->id);
          }

        Auth::login($user);
        }
   //Google Login
   public function redirectToGoogle(){
    return Socialite::driver('google')->stateless()->redirect();

    }

    //Google callback
    public function handleGoogleCallback(){
    $user = Socialite::driver('google')->stateless()->user();
    $user['login_with'] = 'google';
      $this->_registerorLoginUser($user);
      return redirect()->route('payment');
    }

    //Facebook Login
    public function redirectToFacebook(){
    return Socialite::driver('facebook')->stateless()->redirect();
    }

    //facebook callback
    public function handleFacebookCallback(){

    $user = Socialite::driver('facebook')->stateless()->user();

      $this->_registerorLoginUser($user);
      return redirect()->route('payment');
    }

    //Github Login
    public function redirectToGithub(){
    return Socialite::driver('github')->stateless()->redirect();
    }

    //github callback
    public function handleGithubCallback(){

    $user = Socialite::driver('github')->stateless()->user();

      $this->_registerorLoginUser($user);
      return redirect()->route('payment');
    }
}
