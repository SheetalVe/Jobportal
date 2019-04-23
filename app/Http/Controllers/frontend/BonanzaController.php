<?php
namespace App\Http\Controllers\frontend;

use App\User;
use App\Userdetail;
use App\Userdoc;
use App\CirtifyModel;
use App\CertificationconditionsModel;
use App\Shop;

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
class BonanzaController extends Controller
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
        $voucher = Shop::where('voucher_name','Bonanza')->get();     
        return view('frontend.bonanza.bonanza', ['voucher' => $voucher]);   
    }    
}
