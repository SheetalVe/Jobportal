<?php

namespace App\Factories\Surveys;

use App\Services\Parsers\FormDataParser;
use App\Services\Parsers\UserFormDataParser;

class UserDataParserFactory
{
    public static function createDataParser(): FormDataParser {      
                return new UserFormDataParser();
    }
}