<?php
namespace App\Http\Controllers\Auth;


use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Socialite;
use Auth;
use Exception;


class AuthController extends Controller
{


    use  ThrottlesLogins;


    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
            $data = Socialite::driver('linkedin')->user();       
            print_r($data);   exit;
            $count = User::where('linkedin_id','=',$data['id'])->count();   
            if($count == 0)           
            { 
                return User::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],            
                    'email' => $data['email'],
                    'linkedin_id' => $data['id'],
                    
                ]);
            }
            else
            {
                DB::table('users')
                ->where('linkedin_id',$data['id'])
                ->update(array('first_name' =>$data['first_name'],'last_name' => $data['last_name'],'email' => $data['email'],'linkedin_id' => $data['id'],'address' => $address,'lat' => $lat,'long' => $long));
            }
            
        } 
        catch (Exception $e) {
           echo $e;
        }
    }
}