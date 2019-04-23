<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Certifynotification;
use App\Models\admin\Certify;
use Carbon\Carbon;
use App\User;
use App\Models\frontend\UserCertificateModel;
class CertifynotificationController extends Controller
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

   


    public function addCertifyNotificationView(Request $request){
        $page_title = 'Add Certify Notification';
        $btnName = 'Add';
        $certify_list= Certify::all();
        //echo "<pre>"; print_r($certify_list); exit;
        return view('admin.certify.add-certify', compact('btnName','page_title','certify_list'));

    }


    #For Add question
    public function addCertifyNotification(Request $request){
        $this->validate($request,[
            'certify_name' => 'required',
            'desc'=>'required',
        ]);
       
        $certify = Certifynotification::addCertifyNotification($request);
        //check quiz update or save
        if($request->certify_id){
            \Session::flash('errorMsg','Certify Notification updated successfully.');
            return redirect()->route('certifyNotificationViewIssue', ['redirect'=>'true']);
        }
        if($certify== true){
            return redirect()->intended('admin/certify-notification-request-list')->with('status', 'Certify added successfully.');
        }else{
            return redirect()->intended('admin/certify-notification-request-list')->with('status', 'Certify added failed, due to some reason!');
        }
    
    }

    #For View Certification View Request
    public function certifyNotificationViewRequest(){

        $details= DB::table('certify as t1')->join('certificationconditions as t2','t2.cirtificate_type','=','t1.id')->join('choosepersona as t3','t3.id','=','t1.user_type')->where('t2.cerifytype','request')->select('t2.*','t1.certify_name','t3.user_type')->get();
        $btnName = 'Add Certify Notification';
        //echo "<pre>"; print_r($details); exit;
        $page_title = 'Certify Notification List';
        return view('admin.certify.certify-notification-list', compact('details','btnName','page_title'));

    }

    #For View Certification View Issue
    public function certifyNotificationViewIssue(){

        $details= DB::table('certify as t1')->join('certificationconditions as t2','t2.cirtificate_type','=','t1.id')->join('choosepersona as t3','t3.id','=','t1.user_type')->where('t2.cerifytype','issue')->select('t2.*','t1.certify_name','t3.user_type')->get();
        $btnName = 'Add Certify Notification';
      
        $page_title = 'Certify Notification List';
        return view('admin.certify.certify-notification-list', compact('details','btnName','page_title'));

    }


    #For View Certification View
    public function editCertifyNotification($id){
        $certify_list= Certify::all();
        $certify_notification = Certifynotification::where("id","=",$id)->first();
        if($id){
            $certify = Certifynotification::where("id","=",$id)->first();
            $page_title = 'Update cerify Type';
            $btnName = 'Update Type';
            return view('admin.certify.update-notification-list', compact('btnName','page_title','certify','certify_list'));
        }
    }

    #Delete a option from a value
    public function deleteCertifyNotification(Request $request, Certify $certify){
        if(!empty($request->id)){
            $result= Certify::where('id',$request->id)->delete();
            if(!empty($result)){
                return redirect()->intended('admin/certify-list')->with('status', 'Certify deleted successfully.');
            }else{
                return redirect()->intended('admin/certify-list')->with('status', 'Error!!, Please try again');
            }
            
        }  
    }
    #End here

    #For Add assign certification
    public function assignCertification(){

        $user_list= User::all();
        $user_new_list= array();
        foreach ($user_list as $key => $u) {
            $user_new_list[$u->id]= $u->first_name.' '.$u->last_name;
        }
        $user_filter=array_values(array_diff($user_new_list,array(" ","")));
        
        $certify = DB::table('certify')
       ->select('certify.id as certiid','choosepersona.user_type','certify.certify_name','choosepersona.id')
       ->leftJoin('choosepersona', 'choosepersona.id', '=', 'certify.user_type')               
       ->get();

        $certification_list= array();
        foreach ($certify as $key => $c) {
            $certification_list[$c->certiid]= $c->user_type.' '.$c->certify_name;
        }
       
        
        $page_title = 'Assign Certifiation';
        $btnName = 'Add';
        return view('admin.certify.assign-certification', compact('btnName','page_title','user_filter','certification_list'));
        
    }

    
    public function addAssignCertification(Request $request){
        $UserCertificateModel= new UserCertificateModel();
        $this->validate($request,[
            'user_type' => 'required',
            'certificate_type'=>'required',
        ]);
       

        $UserCertificateModel->issued_from_userid=1;
        $UserCertificateModel->issued_to_userid=$request->input('user_type');
        $UserCertificateModel->certificate_id=$request->input('certificate_type');
        $UserCertificateModel->save();
        return redirect()->intended('admin/assign-certification-list')->with('status', 'Assign Certify added successfully.');
       
    }

    public function assignCertificationList(){
        $page_title = 'Assign User certificate List';
        $btnName = 'Assign User';
        $UserCertificate=DB::table("usercertificate as c")->select("c.id",
                                                          DB::raw('CONCAT(table1.first_name, " ", table1.last_name) as issued_from'),
                                                          DB::raw('CONCAT(table2.first_name, " ", table2.last_name) as issued_to'),
                                                          DB::raw('certify.certify_name as certificate_name') )
                    ->join("users as table1","c.issued_from_userid","=","table1.id")
                    ->join("users as table2","c.issued_to_userid","=","table2.id")
                    ->join("certify","c.certificate_id","=","certify.id")
                    ->get()->toArray();

                   
        return view('admin.certify.assign-certification-list', compact('btnName','page_title','UserCertificate'));
        
    }


    public function deleteAssignCertification($id){
        $UserCertificateModel = UserCertificateModel::find($id);
        $UserCertificateModel->delete();
        return redirect()->intended('admin/assign-certification-list')->with('status', 'Assign Certify deleted successfully.');
        
    }

   

}
