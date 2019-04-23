<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        
            $data = Socialite::driver('google')->user();
            if(!isset($data))
            {
                return redirect()->route('login'); 
                exit;
            }
            $arr=   $data->user;
            $arr['first_name']=$arr['name']['givenName'];       
            $arr['last_name']=$arr['name']['familyName'];       
            $arr['email']=$arr['emails'][0]['value'];       
            $arr['gender']="MR";       
            $arr['password']= $arr['id'];       
            $count = User::where('google_id','=', $arr['id'])->count(); 
            if($count == 0)           
            { 
            $userDetail= User::create([
                    'first_name' => $arr['first_name'],
                    'last_name' => $arr['last_name'],            
                    'email' =>  $arr['email'],  
                    'google_id' =>  $arr['id'], 
                    'profilepic' =>  $data->avatar_original, 
                    'password' => Hash::make( $arr['id']),
            
                ]); 
            }
            else
            {
                User::where('google_id', $arr['id'])->update([
                    'first_name' => $arr['first_name'],
                'last_name' => $arr['last_name'],            
                'email' =>  $arr['email'],           
                'profilepic' =>$data->avatar_original,            
                'google_id' =>$arr['id'], 
                ]); 
                $userDetail = User::where('google_id','=',$arr['id'])->first(); 
        
            }
            Auth::loginUsingId($userDetail->id);
            return redirect()->route('quizz');
       
       
    }
}
