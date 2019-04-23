<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Factories\Surveys\UserDataParserFactory;


class AccountService
{
    public function addFormData(Request $request) { 
        $formdata = UserDataParserFactory::createDataParser();
        $data=$formdata->parse($request);
        return $data;
    }    
}