<?php

namespace App\Http\Controllers\frontend;
use App\User;
use App\Userdetail;
use App\Userdoc;
use App\DocMasterModel;
use App\Models\frontend\linkdin_people;
use App\Models\frontend\YoutubeModel;
use App\Models\frontend\SectorModel;
use App\Models\frontend\SectorMainModel;
use App\Models\frontend\UserCertificateModel;
use App\Models\frontend\UserRatingModel;

use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sector = SectorModel::get();


        return view('frontend.myprofile.home', ['users' => $sector]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       // print_r($data);exit;
        return Validator::make($data, [
            'setting' => 'required|string|max:255',
            'type_of_person' => 'required|string|max:255',          
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function updatesetting()
    {
        $id = Input::post('id');
        $setting = Input::post('setting');
        $type_of_person = Input::post('type_of_person');
        if($type_of_person == 'Seed 1' || $type_of_person == 'Seed 2' || $type_of_person == 'Seed 3' || $type_of_person == 'Seed 4'|| $type_of_person == 'Seed 5') 
        {
           $personaid= '1';
        }
        elseif($type_of_person == "Grower") 
        {
           $personaid= '2';
        }
        elseif($type_of_person == "Harvester") 
        {
           $personaid= '3';
        }
        else
        {
            $personaid= '';
        }
        DB::table('users')
        ->where('id', $id)
        ->update(array('setting' => $setting,'type_of_person' => $type_of_person ,'user_type_int' => $personaid));         
        return Redirect::back()->with('message','Operation Successful !');
    }   
     /**
     * update profile picture and name.
     *
     * @param  array  $request
     * @return \App\User
     */
    protected function updateprofile(Request $request)
    {
        $id = Input::post('id');
        $first_name = Input::post('first_name');
        $last_name = Input::post('last_name');
        if ($request->hasFile('profilepic')) 
        {
            $image = $request->file('profilepic');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profilepic');
            $image->move($destinationPath, $name);

            DB::table('users')
            ->where('id', $id)
            ->update(array('profilepic' => '/images/profilepic'.$name,'first_name' => $first_name,'last_name' => $last_name));         
            return Redirect::back()->with('message','Operation Successful !');
        }
        else
        {
            DB::table('users')
            ->where('id', $id)
            ->update(array('first_name' => $first_name,'last_name' => $last_name));         
            return Redirect::back()->with('message','Operation Successful !');

        }
    }  
     /**
     * update profile rest data like email gender and name.
     *
     * @param  array  $request
     * @return \App\User
     */
    protected function updateprofiledata(Request $request)
    {        
        $id = Input::post('id');
        $first_name = Input::post('first_name');
        $last_name = Input::post('last_name');
        $gender = Input::post('gender');
        $contact_no = Input::post('contact_no');
        $address = Input::post('address')." ";
        $prepAddr = str_replace(' ','+',$address);       
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');         
        $output= json_decode($geocode);         
        $lat = isset( $output->results[0]->geometry->location->lat) && $output->results[0]->geometry->location->lat != '' ?  $output->results[0]->geometry->location->lat : '';
        $long = isset(  $output->results[0]->geometry->location->lng) && $output->results[0]->geometry->location->lng != ''?  $output->results[0]->geometry->location->lng : '';
        if ($request->hasFile('profilepic')) 
        {
            $image = $request->file('profilepic');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profilepic');
            $image->move($destinationPath, $name);

            DB::table('users')
            ->where('id', $id)
            ->update(array('profilepic' => 'images/profilepic/'.$name,'first_name' => $first_name,'last_name' => $last_name,'gender' => $gender,'contact_no' => $contact_no,'address' => $address,'lat' => $lat,'long' => $long));         
            return Redirect::back()->with('message','Operation Successful !');
        }
        else
        {
            DB::table('users')
            ->where('id', $id)
            ->update(array('first_name' => $first_name,'last_name' => $last_name,'gender' => $gender,'contact_no' => $contact_no,'address' => $address,'lat' => $lat,'long' => $long));         

            return Redirect::back()->with('message','Operation Successful !');

        } 
       
    }
    protected function updatecompanydata(Request $request)
    {       
        $id = Input::post('id');
        $website = Input::post('website');
        $type_of_company = Input::post('type_of_company');
        $company_name = Input::post('company_name');
        $sector = Input::post('sector1').",".Input::post('sector2').",".Input::post('sector3');
        $crn = Input::post('crn');
        $query = Input::post('query');
        $count = Userdetail::where('userid','=',$id)->count();
        if($count == 0)
        {
             Userdetail::create([
                'userid' => $id,
                'website' => $website,
                'company_name' => $company_name,            
                'type_of_company' => $type_of_company,            
                'sector' => $sector,            
                'crn' => $crn,               
            ]);
        }
        else
        {
            Userdetail::where('userid', $id)->update([
                'website' => $website,
                'company_name' => $company_name,            
                'type_of_company' => $type_of_company,            
                'sector' => $sector,            
                'crn' => $crn,       
            ]);     
           
        }
        if ($request->hasFile('companylogo')) 
        {
            $image = $request->file('companylogo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/companylogo');
            $image->move($destinationPath, $name);
            $doc_file_name=$name;
            Userdetail::where('userid', $id)->update([               
                'companylogo' =>$name ,
            ]); 
            
        }
           
        return Redirect::back()->with('message','Operation Successful !'); 
    }

    protected function updateSlogan(Request $request)
    {        
        $id = Input::post('id');
       
        $slogan = Input::post('slogan');
        $query = Input::post('query');
        $description = Input::post('description');
        $count = Userdetail::where('userid','=',$id)->count();   
        if($count == 0)
        {
             Userdetail::create([
                'userid' => $id,               
                'slogan' => $slogan,
                'query' => $query,
                'description' =>$description ,
            ]);
        }
        else
        {
            Userdetail::where('userid', $id)->update([               
                'slogan' => $slogan,
                'query' => $query,
                'description' =>$description ,
            ]);  
        }
        return Redirect::back()->with('message','Operation Successful !');       
    }
    protected function updatesocialmedia(Request $request)
    {        
        $id = Input::post('id');
       
        $linkedin = Input::post('linkedin');
        $facebook = Input::post('facebook');
        $twitter = Input::post('twitter');
        $google = Input::post('google');
        $count = Userdetail::where('userid','=',$id)->count();   
        if($count == 0)
        {
            Userdetail::create([
                'userid' => $id,               
                'linkedin' => $linkedin,
                'facebook' => $facebook,
                'twitter' =>$twitter ,
                'google' =>$google ,
            ]);
        }
        else
        {
            Userdetail::where('userid', $id)->update([               
                'linkedin' => $linkedin,
                'facebook' => $facebook,
                'twitter' =>$twitter ,
                'google' =>$google ,
            ]);  
        }
        if($request->youtube)
        {
            $id = Input::post('id');

            $deletedRows = YoutubeModel::where('user_id', $id)->delete();

            $youtube=$request->youtube;
            $i=0;
            foreach($youtube as  $youtube)
            {
                if($youtube != "" && $youtube != null)
                {
                    YoutubeModel::create([              
                        'user_id' =>$id ,
                       'youtube_url' =>$youtube
                    ]);
                }                
                $i++;
            }
        }
        return Redirect::back()->with('message','Operation Successful !');       
    }
  
    protected function updatesecurevault(Request $request)
    {        
          
        $id = Input::post('id');
        $doc_type = Input::post('doc_type');         
        $count = Userdetail::where('userid','=',$id)->count();
      
        if ($request->hasFile('doc_name')) 
        {
            $image = $request->file('doc_name');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/document');
            $image->move($destinationPath, $name);
            $doc_file_name=$name;
             Userdoc::create([
              
                'user_id' =>$id ,
                'doc_name' =>$name ,
                'doc_main_type' =>'personae' ,
                'doc_type' =>$doc_type ,
                                  
            ]);
        }      
        return Redirect::back()->with('message','Operation Successful !'); 
       
    }
    protected function updatelinkdin(Request $request)
    {        
          
        $id = Input::post('id');
        if(Input::post('peoplelinkdin'))
        {
           
            $deletedRows = linkdin_people::where('user_id', $id)->delete();

            $peoplelinkdin=Input::post('peoplelinkdin');
            $i=0;
            foreach($peoplelinkdin as  $peoplelinkdin)
            {
                if($peoplelinkdin != "" &&  $peoplelinkdin != null)
                {
                    linkdin_people::create([              
                        'user_id' =>$id ,
                       'linkdinurl' =>$peoplelinkdin,
                       'linkdinname' =>$_POST['peoplelinkdinname'][$i]
                    ]);
                }                
                $i++;
            }
        }
       
        return Redirect::back()->with('message','Operation Successful !'); 
       
    }
     /**
     * update person choose by user at first time login.
     *
     * @param  array  $request
     * @return \App\User
     */
    protected function updateperson()
    {
        
        $id = Input::post('id');
        $type_of_person = Input::post('type_of_person'); 
     if($type_of_person == "Seed 1") 
     {
        $personaid= '1';
     }
     elseif($type_of_person == "Grower") 
     {
        $personaid= '2';
     }
     elseif($type_of_person == "Harvester") 
     {
        $personaid= '3';
     }
     else
     {
         $personaid= '';
     }
       DB::table('users')
            ->where('id', $id)
            ->update(array('type_of_person' => $type_of_person,'user_type_int' => $personaid));         
            return Redirect::back()->with('message','Operation Successful !');
       
    }
    protected function myprofile()
    {
        $id=Auth::user()->id;       
        $sector = SectorMainModel::orderBy('sector', 'asc')->get();
        $Userdetail = Userdetail::where('userid', $id) ->first();
        $certifycon = UserCertificateModel::
        select('certify.cerificate_short_name') ->   
        leftJoin('certify', function($join) {
            $join->on('certify.certificate_id', '=', 'usercertificate.certificate_id');
        })-> 
        where('issued_to_userid', $id)->
        groupBy('certify.cerificate_short_name')->
        get();
        $Userdoc=Userdoc::
        select('documentmaster.doc_type as doctype','userdocs.doc_name','userdocs.id as docids','documentmaster.is_seederdoc') ->
        leftJoin('documentmaster', function($join) {
                $join->on('userdocs.doc_type', '=', 'documentmaster.id');
            })
            ->where('userdocs.user_id', $id)                    
            ->get();  
        $rateavg=UserRatingModel:: where('rating_to_userid',$id)->count();   
        $result = UserRatingModel::selectRaw('sum(rating) as rating' )->where('rating_to_userid',$id)->first();     
        if($rateavg == 0)
        {
            $rating=0;
        }
        else
        {
            $rating=$result->rating/$rateavg;
        }      
        $Userdoc2 = Userdoc::where('user_id', $id)->where('doc_main_type','seed')->get();
        $Youtube = YoutubeModel::where('user_id', $id)->get();
        $linkdin_people = linkdin_people::where('user_id', $id)->get();
        $docdata = DocMasterModel::where('is_seederdoc','=',0)->get();     
        $seederdocdata = DocMasterModel::where('is_seederdoc','=',1)->get();  
        $categoryscores = Userdetail::get_category_score(); 
        $categoryscore = $categoryscores['category_score']; 
        $transparency = $categoryscores['transparency_score']; 
       
        if(isset($Userdetail->sector) && $Userdetail->sector != "") 
        {
            $sectordata=explode(",",$Userdetail->sector);
        }
        $Userdetail['sector1']= isset($sectordata[0]) && $sectordata[0] != '' ?  $sectordata[0] : '';
        $Userdetail['sector2']= isset($sectordata[1]) && $sectordata[1] != '' ?  $sectordata[1] : '';
        $Userdetail['sector3']= isset($sectordata[2]) && $sectordata[2] != '' ?  $sectordata[2] : '';
        return view('frontend.myprofile.myprofile', ['certifycon'=> $certifycon,'rating'=>$rating ,'Youtube' => $Youtube,'categoryscore'=>$categoryscore,'transparency'=>$transparency,'sectors' => $sector,'userDetail' => $Userdetail,'Userdoc'=>$Userdoc,'Userdoc2'=>$Userdoc2,'docdata'=>$docdata,'seederdocdata'=>$seederdocdata,'linkdin_people'=>$linkdin_people]);
    }
    protected function deldoc(Request $request)
    {  
        $deletedRows = Userdoc::where('id', $request->docid)->delete();
        return Redirect::back()->with('message','Operation Successful !'); 

    }
    protected function checkdoctype(Request $request)
    {  
        echo $count = Userdoc::where('user_id','=',Auth::user()->id)->where('doc_type','=',$request->doc_type)->count();
    }
    protected function updateuserdetail(Request $request)
    {     
        $id = Input::post('id');
        $doc_type = Input::post('doc_type');         
        $count = Userdetail::where('userid','=',$id)->count();
        if(Input::post('peoplelinkdin'))
        {
           
            $deletedRows = linkdin_people::where('user_id', $id)->delete();

            $peoplelinkdin=Input::post('peoplelinkdin');
            $i=0;
            foreach($peoplelinkdin as  $peoplelinkdin)
            {
                if($peoplelinkdin != " ")
                {
                    linkdin_people::create([              
                        'user_id' =>$id ,
                       'linkdinurl' =>$peoplelinkdin
                    ]);
                }                
                $i++;
            }
        }
        if ($request->hasFile('doc_name')) 
        {
            $image = $request->file('doc_name');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/document');
            $image->move($destinationPath, $name);
            $doc_file_name=$name;
             Userdoc::create([
              
                'user_id' =>$id ,
                'doc_name' =>$name ,
                'doc_main_type' =>'personae' ,
                'doc_type' =>$doc_type ,
                                  
            ]);
        }      
        return Redirect::back()->with('message','Operation Successful !'); 
       
    }
    protected function changeLanguage(Request $request)
    {  
        session(['locale' => $request->locale]);
        $request->session()->get('locale');
        app()->setLocale($request->session()->get('locale'));  

    }
    
}
