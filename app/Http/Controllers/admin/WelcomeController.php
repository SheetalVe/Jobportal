<?php
/*
 * @Author: Thomas
 * @WelcomeController
 * @Date: 2018-08-29
 * @Last Modified by: Thomas
 * @Last Modified: 2018-08-29
 */

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class WelcomeController extends Controller
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
    public function __construct(){

        $this->middleware('guest')->except('logout');
    }

    public function index(){
       //default function
    }

    /**
    *
    *Function home
    * 
    *admin home page
    *@param ()()
    *@return ()()
    */
    public function home(){

        $page_title = 'Dashboard';
        return view('admin.home.home', compact('page_title'));
    }

    /**
    *
    *Function home
    * 
    *admin home page
    *@param ()()
    *@return ()()
    */
    public function addForm(){

        $page_title = 'Add Form';
        $btnName = 'Add Form';
        return view('admin.form.add-form', compact('btnName','page_title'));
    }
}
