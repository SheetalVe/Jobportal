<?php

namespace App\Services\Parsers;


interface FormDataParser
{
    /**
     * @param array $data raw access token data.
     * @return OauthSurveyToken
     */
    public function parse($request);
}