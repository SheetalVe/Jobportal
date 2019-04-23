<?php
namespace App\Http\Controllers\frontend;
use App\User;
use App\Userdetail;
use App\Userdoc;
use DB;
use App\Models\frontend\SectorModel;
use App\Models\frontend\User_attemp_quiz;
use App\Models\admin\Quiz;
use App\Models\frontend\SectorMainModel;
use App\Models\admin\Question;
use Illuminate\Support\Facades\Redirect;
use App\Models\frontend\YoutubeModel;
use App\Models\frontend\ConnectUserProfileStatusModel;
use App\Models\frontend\linkdin_people;
use App\Models\frontend\UserRatingModel;
use App\Models\frontend\FollowUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Choosepersona;
use App\Models\admin\Certify; 
class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user_type= Auth::user()->user_type_int;
       // $sector=  SectorMainModel::all()->toArray();
        $sector=DB::table("sector_main as t1")->select("*")->orderBy("t1.sector","ASC")->get()->toArray();
        $persona= Choosepersona::all()->toArray();
        $country= DB::table('countries as t1')->select('t1.*')->get()->toArray(); 
        $development_stage= DB::table('development_stage as t1')->select('t1.*')->get()->toArray();
        $certify= DB::table("certify as t1")->join("choosepersona as t2","t2.id","=","t1.user_type")->where("t1.user_type",$user_type)->get()->toArray();
        
        return view('frontend.connect.contact',['sector'=>$sector,'persona'=>$persona,'certify'=>$certify,'country'=>$country,'development_stage'=>$development_stage]);
    }

    public function stylesheet()
    {
       return view('frontend.style.stylesheet');
    }

    protected function connect_my_profile(Request $request)
    {
        if($request->id)
        {   
            $useridcount=User:: where('id',$request->id)->count();     
            if($useridcount == 0)
            {
                return redirect()->route('contact'); 
            }
            else
            {
                $userdata=User::
            select('users.id as userid','userdetails.*','users.*','social_linkdin_accounts.*')
            ->leftJoin('userdetails', function($join) {
                $join->on('users.id', '=', 'userdetails.userid');
            })->
            leftJoin('social_linkdin_accounts', function($join) {
                $join->on('social_linkdin_accounts.userid', '=', 'users.id');
            })
            ->where('users.id', $request->id)           
            ->first(); 
            $sectorDetail=explode(",",$userdata->sector);
            $sector="";
            foreach($sectorDetail as $sectors)
            {
                $sectordata=SectorModel::where('id',$sectors)->first();
                if(isset($sectordata->sector))
                {
                    $sector .=  $sectordata->sector." | ";
                }
                else
                {
                    $sector="";
                }                
            }
        }
        $youtubedata = YoutubeModel::where('user_id', $request->id)->get();
        $linkdin_people = linkdin_people::where('user_id',  $request->id)->get();
        $Youtube=array("");
        foreach($youtubedata as $youtubedata)
        {            
            $expdata=explode("v=",$youtubedata->youtube_url);
            if(isset($expdata[1]) && $expdata[1] != "")
            {
                $Youtube[]=$expdata[1];
            }
           else
           {
                $Youtube[]="";
           }
        }
        //echo  $request->id;exit;
        $userdoc=Userdoc::
        select('documentmaster.doc_type as doctype','userdocs.doc_name as docname')
        ->leftJoin('documentmaster', function($join) {
            $join->on('documentmaster.id', '=', 'userdocs.doc_type');
        })       
        ->where('userdocs.user_id', $request->id)           
        ->get(); 
        $connectprofile = ConnectUserProfileStatusModel::where('request_id', $request->id)->where('user_id', Auth::user()->id)->first();  
        $userdata['reqid']=$request->id;
        $quiz = quiz::get();         
        foreach($quiz as $quizs)
        {
            $totalques[$quizs->quiz_id] = Question::where('quiz_id', $quizs->quiz_id)->count();
            $title[$quizs->quiz_id] = $quizs->title; 
        }
        foreach( $totalques as $key=>$count)
        {                   
            $getscor=User_attemp_quiz:: where('user_id',$request->id)->where('quiz_id',$key)->count();   
            if($count == 0)
            {
                $avrcount[$key] =0;
            }
            else
            {
                $avrcount[$key] =round (( $getscor / $count) * 100);    
            }           
        }
        $narry=array_combine($title,$avrcount);
        $rateavg=UserRatingModel:: where('rating_to_userid',$request->id)->count();   
        $result = UserRatingModel::selectRaw('sum(rating) as rating' )->where('rating_to_userid',$request->id)->first();     
        if($rateavg == 0)
        {
            $rating=0;
        }
        else
        {
            $rating=$result->rating/$rateavg;
        }
        $userdata['userfollowcount']=FollowUserModel::where('follow_from_userid',Auth::user()->id)->where('follow_to_userid',$request->id)->count();        
        $userratingcount=UserRatingModel::where('rating_from_userid',Auth::user()->id)->where('rating_to_userid',$request->id)->first();        
        $userdata['totalfollow']=FollowUserModel::where('follow_to_userid',$request->id)->count();    
        $categoryscores = Userdetail::get_category_scorebyid($request->id);
        $categoryscore = $categoryscores['category_score'];   
        $transparency = $categoryscores['transparency_score']; 

        return view('frontend.connect.connectmyprofile', ['categoryscore'=>$categoryscore,'transparency'=>$transparency,'userratingcount' => $userratingcount,'userdata' => $userdata,'rating'=>$rating,'quiz' => $narry,'sector' => $sector,'Youtube' => $Youtube,'linkdin_people' => $linkdin_people,'userdoc' => $userdoc,'connectprofile' => $connectprofile]);
        }
            
    }
    protected function docacceptreject(Request $request)
    {
        if($request->id)
        {   ConnectUserProfileStatusModel::where('user_id',$request->id )->where('request_id',Auth::user()->id )->update([
            'isdocpermission' => $request->status,  
        ]);        
        }
        return Redirect::back()->with('message','Operation Successful !');
    }
    protected function connect(Request $request)
    {
        if($request->id)
        {   $deletedRows = ConnectUserProfileStatusModel::where('user_id',Auth::user()->id )->where('request_id',$request->id )->delete();
            ConnectUserProfileStatusModel::create([              
                'user_id' =>Auth::user()->id ,
               'request_id' =>$request->id,
               'status' =>'pending',
            ]);       
        }
        return Redirect::back()->with('message','Operation Successful !');
    }
    protected function docrequest(Request $request)
    {
        if($request->id)
        {  
            ConnectUserProfileStatusModel::where('user_id',Auth::user()->id )->where('request_id',$request->id )->update([
                'isdocpermission' => $request->status,  
            ]);          
        }
        return Redirect::back()->with('message','Operation Successful !');
    }
    protected function acceptreject(Request $request)
    {
        if($request->id)
        {   $deletedRows = ConnectUserProfileStatusModel::where('request_id',Auth::user()->id )->where('user_id',$request->id )->delete();
            ConnectUserProfileStatusModel::create([              
                'request_id' =>Auth::user()->id ,
               'user_id' =>$request->id,
               'status' =>$request->status,
            ]);       
        }
        return Redirect::back()->with('message','Operation Successful !');
    }
    protected function user_rating(Request $request)
    {
        $id= Auth::user()->id;
        $reqid= $request->reqid;
        $rate= $request->rate;
        $count=UserRatingModel::where('rating_from_userid',$id)->where('rating_to_userid',$reqid)->count();
        if($count == 0)
        {
            UserRatingModel::create([
                'rating_from_userid' => $id,
                'rating_to_userid' => $reqid,
                'rating' => $rate,            
                           
            ]);
        }
        else
        {
            UserRatingModel::where('rating_from_userid',$id)->where('rating_to_userid',$reqid)->update([
                'rating_from_userid' => $id,
                'rating_to_userid' => $reqid,
                'rating' => $rate,        
            ]);     
           
        }
    }
    protected function follow_user(Request $request)
    {
        $id= Auth::user()->id;
        $follow_to_userid= $request->follow_to_userid;
        $count=FollowUserModel::where('follow_from_userid',$id)->where('follow_to_userid',$follow_to_userid)->count();
        if($count == 0)
        {
            FollowUserModel::create([
                'follow_from_userid' => $id,
                'follow_to_userid' => $follow_to_userid,
                           
            ]);
        }
        else
        {
            FollowUserModel::where('follow_from_userid',$id)->where('follow_to_userid',$follow_to_userid)->update([
                'follow_from_userid' => $id,
                'follow_to_userid' => $follow_to_userid,
            ]); 
        }
    }


    protected function search(Request $request)
    {
        $searchstr=$request->search; 
        $Personatype =$request->input('personatype'); 
        $certificate =$request->input('certificate'); 
        $geography =$request->input('geography'); 
        $development_stage =$request->input('development_stage');
        $sectors =$request->input('sector');

        if(empty($Personatype) && empty($certificate) && empty($development_stage) && empty($sectors) && empty($searchstr)){
            return redirect()->route('contact')->with('message','Please select one!!');
            //return Redirect::back()->with('message','Please select one!!');
        }
       // echo $Personatype; exit;
         $searchdata=DB::table('users as t1')
                        ->leftJoin("userdetails as t2","t1.id","=" ,"t2.userid");
                        if(!empty($Personatype))
                           $searchdata= $searchdata->where('t1.user_type_int',$Personatype);
                        if(!empty($certificate))
                           $searchdata=$searchdata->Where('t1.country',$certificate);
                        if(!empty($development_stage))
                           $searchdata=$searchdata->Where('t2.sector',$development_stage);
                        if(!empty($sectors))
                             $searchdata=$searchdata->Where('t2.slogan',$sectors);
                        if(!empty($searchstr))
                            $searchdata=$searchdata->orWhere('t1.first_name', 'like', '%' .$searchstr . '%');
                            $searchdata=$searchdata->orWhere('t1.last_name', 'like', '%' .$searchstr . '%');
                            $searchdata=$searchdata->orWhere('t2.company_name', 'like', $searchstr . '%');
                    

        $searchdata= $searchdata->select("t1.*","t2.company_name")->get();
        //echo "<pre>"; print_r($searchdata); exit;

              
        foreach($searchdata as $i=>$val)
        {
            $rateavg=UserRatingModel:: where('rating_to_userid',$val->id)->count();   
            $result = UserRatingModel::selectRaw('sum(rating) as rating' )->where('rating_to_userid',$val->id)->first(); 
           
                if($rateavg == 0)
                {
                    $rate[$val->id]=0;
                    $searchdata[$i]->rating=0;
        
                } elseif($rateavg > 0)
                {
                    $rate[$val->id]=round($result->rating/$rateavg);
                    $searchdata[$i]->rating =round($result->rating/$rateavg);
        
                }
               
        }  

    /*foreach($searchdata as $i=>$val) {
        $userid= Auth::user()->id;
        $user_type= Auth::user()->user_type_int;  
        $calculation=  User_attemp_quiz::groupBy('question_id')->where(array("quiz_id"=>1,"user_id"=>$val->id,"user_type"=>1))->get()->toArray();
        
        if(!empty($calculation)){
           #For User Attemp calculation
           $BackgroundTransparencyRating =0;
           $ProductTransparencyRating=0;
           $MarketingTransparencyRating=0;
           $PeopleTransparencyRating=0;
           $FinanceTransparencyRating=0;
           $IPTransparencyRating=0;
           $FundingRequestTransparencyRating=0;
           $EquityRequestTransparencyRating=0;
           $DebtRequestTransparencyRating=0;
           $PeopleRequestTransparencyRating=0;
      
            foreach ($calculation as $key => $c){
              
                $result=   DB::table("user_attemp_quiz as t1")->join("question as t2","t2.question_id","=","t1.question_id")
                                                            ->where(["t1.question_id"=>$c['question_id'],"t1.user_type"=>$user_type])
                                                            ->select('t2.*')->get()->first();
                $BackgroundTransparencyRating= $BackgroundTransparencyRating+($result->answer*$result->BackgroundTransparencyRating / 100);
                $ProductTransparencyRating=   $ProductTransparencyRating+($result->answer*$result->ProductTransparencyRating / 100);
                $MarketingTransparencyRating= $MarketingTransparencyRating+($result->answer*$result->MarketingTransparencyRating / 100);
                $PeopleTransparencyRating=$PeopleTransparencyRating+($result->answer*$result->PeopleTransparencyRating / 100);
                $FinanceTransparencyRating=$FinanceTransparencyRating+($result->answer*$result->FinanceTransparencyRating / 100);
                $IPTransparencyRating=$IPTransparencyRating+($result->answer*$result->IPTransparencyRating / 100);
                $FundingRequestTransparencyRating=$FundingRequestTransparencyRating+($result->answer*$result->FundingRequestTransparencyRating / 100);
                $EquityRequestTransparencyRating=$EquityRequestTransparencyRating+($result->answer*$result->EquityRequestTransparencyRating / 100);
                $DebtRequestTransparencyRating=$DebtRequestTransparencyRating+($result->answer*$result->DebtRequestTransparencyRating / 100);
                $PeopleRequestTransparencyRating=$PeopleRequestTransparencyRating+($result->answer*$result->PeopleRequestTransparencyRating / 100);
                $totalCategoryValue =   $BackgroundTransparencyRating + $ProductTransparencyRating + $MarketingTransparencyRating + $PeopleTransparencyRating + $FinanceTransparencyRating + $IPTransparencyRating + $IPTransparencyRating + $FundingRequestTransparencyRating + $EquityRequestTransparencyRating +  $DebtRequestTransparencyRating + $PeopleRequestTransparencyRating; 
                $searchdata[$i]->score= $totalCategoryValue; 
            }
        } else {
            $searchdata[$i]->score= 0;
        }
    }*/

        //echo "<pre>"; print_r($searchdata); exit;
        $user_type= Auth::user()->user_type_int;
       // $sector=  SectorMainModel::all()->toArray();
        $sector=DB::table("sector_main as t1")->select("*")->orderBy("t1.sector","ASC")->get()->toArray();
        $persona= Choosepersona::all()->toArray();
        $country= DB::table('countries as t1')->select('t1.*')->get()->toArray(); 
        $development_stage= DB::table('development_stage as t1')->select('t1.*')->get()->toArray();
        $certify= DB::table("certify as t1")->join("choosepersona as t2","t2.id","=","t1.user_type")->where("t1.user_type",$user_type)->get()->toArray();       
    return view('frontend.connect.contact', ['searchdatas' => $searchdata,'sector'=>$sector,'persona'=>$persona,'certify'=>$certify,'country'=>$country,'development_stage'=>$development_stage]);
        //return view('frontend.connect.contact', ['searchdata' => $searchdata,'rating'=>$rate]);    
    }
}
