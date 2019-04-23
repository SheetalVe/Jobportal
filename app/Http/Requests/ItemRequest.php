<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [           
            'position_applied' => 'bail|required',
            'exp_sal'=> 'required|numeric',
            'when_join_company'=> 'required',
            'referral_source'=>'required',
            'name_of_source'=> 'required',
            'full_name'=> 'required',
            'passport_number'=> 'required',
            'gender'=>'required',
            'religion'=> 'required',
            'citizenship' => 'bail|required',
            'marital_status'=> 'required',
            'race'=> 'required',
            'nationality'=>'required',
            'driving_licence'=> 'required',
            'cns' => 'bail|required',
            'home_address'=> 'required',
            'home_tel'=> 'required',
            'email_id'=>'required|email',
            'dob_place'=> 'required',
            'pass_type' => 'bail|required',
            'pass_issued'=> 'required',
            'interest'=> 'required',
            'emergency_name'=>'required',
            'emergency_tel'=> 'required',
            'emergency_address'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'position_applied.required' => 'Please enter the position applied',
            'exp_sal.required'  => 'Please enter the expected salary',
            'when_join_company.required' => 'Please enter when you join the company',
            'referral_source.required' => 'Please check if you have referral source or not',
            'name_of_source.required' => 'Please enter the name of the source',
            'position_applied.required' => 'Please enter the position applied',
            'full_name.required'  => 'Please enter your full name',
            'passport_number.required' => 'Please enteryour paasport number',
            'gender.required' => 'Please select the gender',
            'religion.required' => 'Please select your religion',
            'citizenship.required' => 'Please enter your citizenship',
            'marital_status.required' => 'Please select your marital status',
            'race.required' => 'Please enter the race',
            'nationality.required' => 'Please enter your nationality',
            'driving_licence.required' => 'Please enter your driving licence',
            'cns.required' => 'Please select complete national service',
            'home_address.required' => 'Please enter your home address',
            'home_tel.required' => 'Please enter your home telephone number',
            'email_id.required' => 'Please enter your email id',
            'dob_place.required' => 'Please enter your DOB/Place',
            'pass_issued.required' => 'Please enter Pass Issued By',
            'pass_type.required' => 'Please enter the Pass Type',
            'interest.required' => 'Please enter your interest',
            'emergency_name.required' => 'Please enter the emergency name',
            'emergency_tel.required' => 'Please enter the emergency telephone number',
            'emergency_address.required' => 'Please enter the emergency address',
        ];
    }
}
