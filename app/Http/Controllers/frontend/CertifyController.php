<?php
namespace App\Http\Controllers\frontend;

use App\User;
use App\Userdetail;
use App\Userdoc;
use App\CirtifyModel;
use App\CertificationconditionsModel;
use App\Models\frontend\UserCertificateModel;

use DB;
use App\Mail\VerifyEmail;
use Mail;
use App\DocMasterModel;
use Illuminate\Support\Facades\Redirect;
use App\Choosepersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Issue_certificate;
use App\Requestcertify;
class CertifyController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        $growerarr=array('Grower');
        $seedarr=array('Seed 1','Seed 2','Seed 3','Seed 4','Seed 5');
        $harvesterarr=array('Harvester');
        $typeofuser= Auth::user()->type_of_person;        
        if(in_array($typeofuser,$seedarr))
        {
            $choosepersona=1;
        }
        elseif(in_array($typeofuser,$growerarr))
        {
            $choosepersona=2;
        }
        else
        {
            $choosepersona=3;
        }
        if(!empty(session()->get('locale')))
        {
            $lang= session()->get('locale');
        }
        else
        {
            $lang='en';
        }
        $certify = DB::table('certify')
            ->leftJoin('choosepersona', 'choosepersona.id', '=', 'certify.user_type')
            ->where('certify.user_type', $choosepersona)        
            ->where('certify.language_id', $lang)           
   
            ->get();
        $choosepersonadetail = DB::table('choosepersona')           
            ->where('id', $choosepersona)           
            ->first();
        return view('frontend.certificate.certify', ['CertifyData' => $certify,'choosepersona' => $choosepersonadetail]);
    }    
    protected function sendmail()
    {
        $user=array("");
		        $email= Auth::user()->email;        

        Mail::send('frontend.certificate.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from($email, 'Your Application');        
           // $m->to("sheetalrawat@virtualemployee.com", "sheetal")->subject('Please find me a Sponsor!');
        $m->to("certify@noogah.com", "noogah")->subject('Please find me a Sponsor!');
        });
    }
    protected function RequestCertification()
    {       
        $id = Input::post('id');
        $growerarr=array('Grower');
        $seedarr=array('Seed 1','Seed 2','Seed 3','Seed 4','Seed 5');
        $harvesterarr=array('Harvester');
        $typeofuser= Auth::user()->type_of_person;        
        if(in_array($typeofuser,$seedarr))
        {
            $choosepersona=1;
        }
        elseif(in_array($typeofuser,$growerarr))
        {
            $choosepersona=2;
        }
        else
        {
            $choosepersona=3;
        }
        if(!empty(session()->get('locale')))
        {
            $lang= session()->get('locale');
        }
        else
        {
            $lang='en';
        }
        $certify = DB::table('certify')
            ->select('certify.id as certiid','certify.certificate_id as certificate_id','choosepersona.user_type','certify.certify_name','choosepersona.id')
            ->leftJoin('choosepersona', 'choosepersona.id', '=', 'certify.user_type')   
            ->where('certify.language_id', $lang)                  
            ->get();
        $choosepersonadetail = DB::table('choosepersona')           
            ->where('id', $choosepersona)           
            ->first();  
        $docdata = DocMasterModel::where('is_seederdoc','=',0)->get();     
        $seederdocdata = DocMasterModel::where('is_seederdoc','=',1)->get();      
        return view('frontend.certificate.requestcertification', ['CertifyData' => $certify,'choosepersona' => $choosepersonadetail,'docdata' => $docdata,'seederdocdata' => $seederdocdata]);
    }
    protected function CreateRequest(Request $request)
    {
        $id = $request->id;
        $typeOfCertification = $request->typeOfCertification;
        $sponsor_id = $request->sponserInMyConnection;
        $information_available = $request->information_available;
        $sponserSelection	=  $request->sponserSelection;
        $sponsoroutside = $request->sponsoroutside;
        $all_persona_doc =  $request->doc_type;
        $all_seeder_doc =  $request->doc_type2;
        $comments	 =  $request->comments;   
        $payment_method	 =  $request->payment_method;          
        $voucher_code	 = $request->voucher_code;   
        if(isset($sponsoroutside) && $sponsoroutside != "")  
        {
            $user=array("");
            Mail::send('frontend.certificate.sponsoroutside', ['user' => $user], function ($m) use ($user) {
                $m->from('admin@noogah.com', 'Your Application');        
                $m->to("certify@noogah.com", "noogah")->subject(' Suggest a sponsor from outside noogah');
            });
        }
        Requestcertify::create([
            'user_id' => $id,
            'sponsor_id' => $sponsor_id,
            'certify_id' => $typeOfCertification,
            'information_available' => $information_available,            
            'all_persona_doc' => $all_persona_doc,            
            'all_seeder_doc' => $all_seeder_doc,
            'comments' => $comments,
            'payment_method' => $payment_method,          
                                
        ]);          
        return redirect()->route('certify');
    }
    protected function IssueCertification()
    {       
        $growerarr=array('Grower');
        $seedarr=array('Seed 1','Seed 2','Seed 3','Seed 4','Seed 5');
        $harvesterarr=array('Harvester');
        $typeofuser= Auth::user()->type_of_person;
        $user_id= Auth::user()->id;     
        //die();   
        if(in_array($typeofuser,$seedarr))
        {
            $choosepersona=1;
        }
        elseif(in_array($typeofuser,$growerarr))
        {
            $choosepersona=2;
        }
        else
        {
            $choosepersona=3;
        }
        if(!empty(session()->get('locale')))
        {
            $lang= session()->get('locale');
        }
        else
        {
            $lang='en';
        }
       // die();
       $certify = DB::table('certify')
       ->select('certify.id as certiid','certify.certificate_id as certificate_id','choosepersona.user_type','certify.certify_name','choosepersona.id')
       ->leftJoin('choosepersona', 'choosepersona.id', '=', 'certify.user_type')
       ->where('certify.language_id', $lang)                 
       ->get();
        $choosepersonadetail = DB::table('choosepersona')           
            ->where('id', $choosepersona)           
            ->first();    
            $docdata = DocMasterModel::where('is_seederdoc','=',0)->get();     
            $seederdocdata = DocMasterModel::where('is_seederdoc','=',1)->get();
        return view('frontend.certificate.issuecertification', ['CertifyData' => $certify,'choosepersona' => $choosepersonadetail,'docdata' => $docdata,'seederdocdata' => $seederdocdata]);
    }
    public function update_certification(Request $request)
    {       
        $personal = 'personal';
        $seed = 'seed';       
        $cert = new Issue_certificate;
        $cert->user_id = $request->id;
        $cert->certificate_type = $request->certificate_type;
        $cert->info_made_available = $request->info_made_available;
        $cert->connection_candidate = $request->connection_candidate;
        $cert->document_name = $request->document_name;
        $cert->seeder_document_name = $request->seeder_document_name;
        $cert->certifier_comments = $request->certifier_comments;
        $cert->voucher_code = $request->voucher_code;
        $cert->rating = $request->rate;
        if(isset($request->checkbox1) && $request->checkbox1 != "")
        {
            $cert->checkbox ='1';
        }
        else
        {
            $cert->checkbox ='2';
        }
        $cert->save();
        $issuecert = new UserCertificateModel;
        $issuecert->issued_from_userid = $request->id;
        $issuecert->issued_to_userid = $request->connection_candidate;
        $issuecert->certificate_id	 = $request->certificate_type;
        $issuecert->save();        
        $user=User::where('id',$request->connection_candidate)->first();
        $certificate_type = DB::table('certify')
       ->select('certify.id as certiid','choosepersona.user_type','certify.certify_name','choosepersona.id')
       ->leftJoin('choosepersona', 'choosepersona.id', '=', 'certify.user_type')               
       ->where('certify.id',$request->certificate_type)->first();
        Mail::send('frontend.certificate.issuecertificationmail',['user' =>$user,'certificate_type' =>$certificate_type,'request'=>$request], function ($m) use ($user) {
        $m->from('admin@noogah.com', 'Your Application');        
        $m->to("certify@noogah.com", "noogah")->subject('Issue Certificate');
        //$m->to("sheetalrawat@virtualemployee.com", "noogah")->subject('Issue Certificate');
        });
        return redirect()->route('certify');
    }
    public function getcertificate(Request $request)
    {       
        $data = CertificationconditionsModel::where('cirtificate_type','=',$request->val)->where('cerifytype','=',$request->certificationtype)->get();
        $str="";
        $i=1;
        foreach($data as $val) 
        {
            if($i > 1)
            {
              $str .="<br><strong>OR</strong><br>"; 
            }
          $str .=$i.") ".$val->description." <strong>".$val->relation_by."</strong>";
         
          $i++;
        }        
       $response = array(
        'status' => 'success',
        'str' => $str,
        );
        return response()->json($response); 
     }
     public function getissuecertificate(Request $request)
     {       
         $authid= $request->authid;
         $data = CertificationconditionsModel::where('cirtificate_type','=',$request->val)->where('cerifytype','=',$request->certificationtype)->first();

         $count=UserCertificateModel::where('issued_to_userid','=',$authid)->whereIn('certificate_id', [$data->needed_certificate])->count();
         if($count > 0)
         {
             $str="";
             $status="success";
             $str .=$data->description." <strong>".$data->relation_by."</strong>";
         }
         else
         {
             $str="";
             $status="fail";
             $str ="You are not eligible to issue this certificate";
         }       
         $response = array(

         'status' => $status,
         'count' => $count,
         'str' => $str,
         );
         return response()->json($response); 
     }
}
