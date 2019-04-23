<?php
/*
 * @Author: Thomas
 * @AdminAuthController
 * @Date: 2018-08-29
 * @Last Modified by: Thomas
 * @Last Modified: 2018-08-29
 */

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;

class AdminAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //public $layout = 'admin.layouts.default';

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    *
    *Function index
    * 
    *default function of controller
    *@param ()()
    *@return ()()
    */
    public function index()
    {
        return view('home');
    }


    /**
    *
    *Function loginForm
    * 
    *load view for admin login
    *@param ()()
    *@return ()()
    */
    public function loginForm(){
        
        return view('admin/login');
    }

    /**
    *
    *Function authenticate
    * 
    *admin authentication goes here
    *@param (array)($request)username
    *@param (array)($request)password
    *@return (array)(view)
    */
    public function authenticate(Request $request){

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->username;
        $password = $request->password;
        if (auth()->guard('admin')->attempt(['username' => $username, 'password' => $password ])) 
        {

            return redirect()->intended('admin/home');
        }
        else
        {
            return redirect()->intended('admin/login')->with('status', 'Invalid Login Credentials !');
        }

    }

    /**
    *
    *Function logout
    * 
    *admin logout
    *@param ()()
    *@return ()()
    */
    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->intended('admin/login')->with('status', 'You have successfully logged out!');
    }
}
