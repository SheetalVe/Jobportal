<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Certify;
use Carbon\Carbon;

class CertifyController extends Controller
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function addCertifyView(Request $request)
    {
        $page_title = 'Add Certify';
        $btnName = 'Add Certify';
        $personaType= array("1"=>"Seeder","2"=>"Growers","3"=>"Harvesters");
        $LanguageType= array("en"=>"English","fr"=>"French","sp"=>"Spanish");
        return view('admin.certify.add-certify', compact('btnName','page_title','personaType','LanguageType'));
    }
    #For Add question
    public function addCertify(Request $request)
    {
        $this->validate($request,[
            'user_type' => 'required',
            'certify_name' => 'required',
            'desc'=>'required',
        ]);       
        $certify = Certify::addCertify($request);
        //check quiz update or save
        if($request->certify_id)
        {
            \Session::flash('errorMsg','Certify updated successfully.');
            return redirect()->route('certifylist', ['redirect'=>'true']);
        }
        if($certify== true)
        {
            return redirect()->intended('admin/add-certify-view')->with('status', 'Certify added successfully.');
        }
        else
        {
            return redirect()->intended('admin/add-certify-view')->with('status', 'Certify added failed, due to some reason!');
        }    
    }
    #For View Question
    public function certifyView()
    {
        $details= Certify::all();
        $btnName = 'Add Certify';
        $page_title = 'Certify List';
        return view('admin.certify.certify-list', compact('details','btnName','page_title'));
    }
    #For Edit Question
    public function editCertify(Request $request)
    {
        if($request->id)
        {
            $certify = Certify::where("id","=",$request->id)->first();          
            $page_title = 'Update cerify Type';
            $btnName = 'Update Type';           
            $personaType= array("1"=>"Seeder","2"=>"Growers","3"=>"Harvesters");           
            $LanguageType= array("en"=>"English","fr"=>"French","sp"=>"Spanish");
            return view('admin.certify.update-certify', compact('btnName','page_title','certify','personaType','LanguageType'));
        }
    }
    #Delete a option from a value
    public function delete(Request $request, Certify $certify)
    {       
        if(!empty($request->id))
        {
            $result= Certify::where('id',$request->id)->delete();
            if(!empty($result))
            {
                return redirect()->intended('admin/certify-list')->with('status', 'Certify deleted successfully.');
            }
            else
            {
                return redirect()->intended('admin/certify-list')->with('status', 'Error!!, Please try again');
            }            
        }        
    }
    #End here
}
