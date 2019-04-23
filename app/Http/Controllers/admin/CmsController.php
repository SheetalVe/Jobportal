<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\CmsModel;
use Carbon\Carbon;

class CmsController extends Controller
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
    **/
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function addCmsView(Request $request)
    {
        $page_title = 'Add Cms';
        $btnName = 'Add Cms';
        $LanguageType= array("en"=>"English","fr"=>"French","sp"=>"Spanish");
        $cmspagename= CmsModel::select('page_name')->groupBy('page_name')->get();
        $cmspagename_list= array();
        foreach ($cmspagename as $key => $c) {
            $certification_list[$c->page_name]= $c->page_name;
        }
        $certification_list['0']= 'Other';
        return view('admin.cms.add-cms', compact('btnName','page_title','LanguageType','certification_list'));
    }
    #For Add question
    public function addCms(Request $request)
    {
        $this->validate($request,[
            'language_type' => 'required',
         
            'text'=>'required',
        ]);       
        $certify = CmsModel::addCms($request);
        //check quiz update or save
        if($request->cms_id)
        {
            \Session::flash('errorMsg','Cms updated successfully.');
            return redirect()->route('cmslist', ['redirect'=>'true']);
        }
        if($certify == true)
        {
            return redirect()->intended('admin/add-cms-view')->with('status', 'Cms added successfully.');
        }
        else
        {
            return redirect()->intended('admin/add-cms-view')->with('status', 'Cms added failed, due to some reason!');
        }    
    }   
    #For View Question
    public function CmsView()
    {
        $details= CmsModel::all();
        $btnName = 'Add Cms';
        $page_title = 'Cms List';
        return view('admin.cms.cms-list', compact('details','btnName','page_title'));
    }
    #For Edit Question
    public function editCms(Request $request)
    {
        if($request->id)
        {
            $cms = CmsModel::where("id","=",$request->id)->first();
            $page_title = 'Update cms ';
            $btnName = 'Update Type';
            $LanguageType= array("en"=>"English","fr"=>"French","sp"=>"Spanish");
            $cmspagename= CmsModel::select('page_name')->groupBy('page_name')->get();
            $cmspagename_list= array();
            foreach ($cmspagename as $key => $c) {
                $certification_list[$c->page_name]= $c->page_name;
            }
            $certification_list['0']= 'Other';
            return view('admin.cms.update-cms', compact('btnName','page_title','cms','LanguageType','certification_list'));
        }
    }
    #Delete a option from a value
    public function delete(Request $request, CmsModel $certify)
    {       
        if(!empty($request->id))
        {
            $result= CmsModel::where('id',$request->id)->delete();
            if(!empty($result))
            {
                return redirect()->intended('admin/cms-list')->with('status', 'Cms deleted successfully.');
            }
            else
            {
                return redirect()->intended('admin/cms-list')->with('status', 'Error!!, Please try again');
            }            
        }      
    }
    #End here
}
