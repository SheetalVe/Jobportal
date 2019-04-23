<?php

namespace App\Services\Parsers;

use App\Models\ApplicationForm;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Carbon\Carbon;

class UserFormDataParser implements FormDataParser
{
    public function parse($request) {
        $addapplicationform = new  ApplicationForm;
        $addapplicationform->genrated_id = Str::random(32);        
        $addapplicationform->position_applied = Crypt::encryptString($request->position_applied);
        $addapplicationform->exp_sal = Crypt::encryptString($request->exp_sal);
        $addapplicationform->when_join_company = Crypt::encryptString($request->when_join_company);
        $addapplicationform->referral_source = $request->referral_source;
        $addapplicationform->name_of_source = Crypt::encryptString($request->name_of_source);    
        $addapplicationform->save();       
        $id=$addapplicationform->id;
        $UserDetail = new  UserDetail;
        $UserDetail->application_id = $id;
        $UserDetail->full_name = Crypt::encryptString($request->full_name);
        $UserDetail->gender = $request->gender;
        $UserDetail->passport_number = Crypt::encryptString($request->passport_number);
        $UserDetail->religion = $request->religion;    
        $UserDetail->citizenship = Crypt::encryptString($request->citizenship);    
        $UserDetail->marital_status = $request->marital_status;    
        $UserDetail->race = Crypt::encryptString($request->race);    
        $UserDetail->nationality = Crypt::encryptString($request->nationality);    
        $UserDetail->driving_licence = Crypt::encryptString($request->driving_licence);    
        $UserDetail->cns = Crypt::encryptString($request->cns);    
        $UserDetail->home_address = Crypt::encryptString($request->home_address);
        $UserDetail->home_tel=Crypt::encryptString($request->home_tel);    
        $UserDetail->email_id=Crypt::encryptString($request->email_id);    
        $UserDetail->dob_place = Crypt::encryptString($request->dob_place);    
        $UserDetail->pass_type = Crypt::encryptString($request->pass_type);    
        $UserDetail->pass_issued = Crypt::encryptString($request->pass_issued);    
        $UserDetail->emergency_name = Crypt::encryptString($request->emergency_name);    
        $UserDetail->emergency_tel = Crypt::encryptString($request->emergency_tel);    
        $UserDetail->emergency_address = Crypt::encryptString($request->emergency_address);    
        $UserDetail->save();     
        return true;
    }
}