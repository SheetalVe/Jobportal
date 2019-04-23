<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;
use App\Sector;
use App\Userdetail;
use App\updatelinkdinprofile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Socialite;
use DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers,ThrottlesLogins;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/quizz';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],            
            'email' => $data['email'],
            'gender' => $data['gender'],
            'type_of_person' => "",
            'password' => Hash::make($data['password']),
        ]);
    }
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }
    public function handleLinkedinCallback()
    {
        try 
        {
        $data = Socialite::driver('linkedin')->stateless()->user(); 
        $token=$data->token;
        if(!isset($data))
        {
            return redirect()->route('login'); 
            exit;
        }
        $arr=   $data->user;
        $avatar= $data->avatar_original;
      
        $sector=Sector::where('LinkedinDescription','=',$arr['industry'])->first(); 
        $address=$arr['location']['name']." ";
        $prepAddr = str_replace(' ','+',$address);        
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');         
        $output= json_decode($geocode);         
        $lat = isset( $output->results[0]->geometry->location->lat) && $output->results[0]->geometry->location->lat != '' ?  $output->results[0]->geometry->location->lat : '';
        $long = isset(  $output->results[0]->geometry->location->lng) && $output->results[0]->geometry->location->lng != ''?  $output->results[0]->geometry->location->lng : '';
       
        $arr['first_name']=$arr['firstName'];       
        $arr['last_name']=$arr['lastName'];       
        $arr['email']=$arr['emailAddress'];       
        $arr['gender']="MR";       
        $arr['password']=$arr['id'];       
        $count = User::where('linkedin_id','=',$data['id'])->count(); 
        if($count == 0)           
        { 
           $userDetail= User::create([
                'first_name' => $arr['firstName'],
                'last_name' => $arr['lastName'],            
                'email' =>  $arr['emailAddress'], 
                'profilepic' =>  $avatar, 
                'address' => $address ,         
                'lat' => $lat,           
                'long' => $long,           
                'linkedin_id' =>  $arr['id'], 
                'password' => Hash::make( $arr['id']),
          
            ]); 
        }
        else
        {
            User::where('linkedin_id', $arr['id'])->update([
                 'first_name' => $arr['firstName'],
            'last_name' => $arr['lastName'],            
            'email' =>  $arr['emailAddress'],           
            'profilepic' =>  $avatar, 
          
            'address' => $address ,         
            'lat' => $lat,           
            'long' => $long,           
            'linkedin_id' =>  $arr['id'], ]);
            $userDetail = User::where('linkedin_id','=',$data['id'])->first();
        }
        $CountUserDetail = Userdetail::where('userid','=',$userDetail->id)->count(); 
        $Countupdatelinkdinprofile = updatelinkdinprofile::where('userid','=',$userDetail->id)->count(); 
        $firstName=isset(  $arr['firstName'])?  $arr['firstName'] : '';
        $summary=isset(  $arr['summary']) && $arr['summary'] !="" ?  $arr['summary'] : '';
        $headline=isset(  $arr['headline'])?  $arr['headline'] : '';
        $industry=isset(  $arr['industry'])?  $arr['industry'] : '';
        $locationname=isset(  $arr['location']['name'])?  $arr['location']['name'] : '';
        $numConnections=isset(  $arr['numConnections'])?  $arr['numConnections'] : '';
        $pictureUrl=isset( $arr['pictureUrl'])?  $arr['pictureUrl']: '';
        $positionid=isset( $arr['positions']['values'][0]['id'])? $arr['positions']['values'][0]['id'] : '';
        $siteStandardProfileRequest=isset($arr['siteStandardProfileRequest']['url'])?$arr['siteStandardProfileRequest']['url'] : '';
        $apiStandardProfileRequest=isset($arr['apiStandardProfileRequest']['url'])?$arr['apiStandardProfileRequest']['url'] : '';
        $positiontitle=isset($arr['positions']['values'][0]['title'])? $arr['positions']['values'][0]['title'] : '';
        $positionstartdate=isset($arr['positions']['values'][0]['startDate'])? $arr['positions']['values'][0]['startDate']['month'].",".$arr['positions']['values'][0]['startDate']['year'] : '';
        $positionisCurrent=isset( $arr['positions']['values'][0]['isCurrent'])? $arr['positions']['values'][0]['isCurrent']: '';
        $positioncompanyid=isset( $arr['positions']['values'][0]['company']['id'])? $arr['positions']['values'][0]['company']['id']: '';
        $positioncompanyindustry=isset( $arr['positions']['values'][0]['company']['industry'])? $arr['positions']['values'][0]['company']['industry']: '';
        $positioncompanyname=isset( $arr['positions']['values'][0]['company']['name'])? $arr['positions']['values'][0]['company']['name']: '';
        $positioncompanysize=isset( $arr['positions']['values'][0]['company']['size'])? $arr['positions']['values'][0]['company']['size']: '';
        $positioncompanytype=isset( $arr['positions']['values'][0]['company']['type'])? $arr['positions']['values'][0]['company']['type']: '';

        $positioncompany=isset( $arr['positions']['values'][0]['company'])? $positioncompanyid." ,".$positioncompanyindustry." ,".$positioncompanyname ." ,".$positioncompanysize." ,".$positioncompanytype : '';
        if($CountUserDetail == 0)           
        { 
            Userdetail::create([
                'sector' => $sector->sector_id.',',
                'userid' => $userDetail->id,   
                'headline' =>  $arr['headline'],  
                'industry' =>  $arr['industry'],  
                
            ]); 
        }
        else
        {
            Userdetail::where('userid', $userDetail->id)->update([
                'sector' => $sector->sector_id.',',
                'headline' =>  $arr['headline'],
                'industry' =>  $arr['industry'],
             
                ]);      
        }
      
        if($Countupdatelinkdinprofile == 0)           
        { 
               
            updatelinkdinprofile::create([
                'userid' => $userDetail->id,   
                'linkdin_id' =>  $data->id,  
                'first-name' =>  $arr['firstName'],  
                'last-name' =>  $arr['lastName'],     
                'headline' =>$headline,        
                'location' =>$locationname,   
                'industry' => $industry,   
                'summary' =>$summary,   
                'specialties' =>'',   
                'num-connections' => $numConnections,   
                'picture-url' =>  $pictureUrl,   
                'site-standard-profile-request' => $siteStandardProfileRequest,   
                'api-standard-profile-request' => $apiStandardProfileRequest,   
                'position-id' => $positionid,   
                'position-summary' =>$summary,   
                'position-title' => $positiontitle,   
                'position-start-date' =>$positionstartdate,   
                'position-end-date' => '',   
                'position-iscurrent' => $positionisCurrent,   
                'position-company' => $positioncompany
            ]); 
        }
        else
        {
            updatelinkdinprofile::where('userid', $userDetail->id)->update([
                'userid' => $userDetail->id,   
                'linkdin_id' =>  $data->id,  
                'first-name' =>  $arr['firstName'],  
                'last-name' =>  $arr['lastName'],     
                'headline' =>$headline,        
                'location' =>$locationname,   
                'industry' => $industry,   
                'summary' =>$summary,   
                'specialties' =>'',   
                'num-connections' => $numConnections,   
                'picture-url' =>  $pictureUrl,   
                'site-standard-profile-request' => $siteStandardProfileRequest,   
                'api-standard-profile-request' => $apiStandardProfileRequest,   
                'position-id' => $positionid,   
                'position-summary' =>$summary,   
                'position-title' => $positiontitle,   
                'position-start-date' =>$positionstartdate,   
                'position-end-date' => '',   
                'position-iscurrent' => $positionisCurrent,   
                'position-company' => $positioncompany
            ]); 
        }
        Auth::loginUsingId($userDetail->id);
        return redirect()->route('quizz'); 
    } catch (Exception $e) {
        return redirect()->route('login'); 
    }                
    }
}   
