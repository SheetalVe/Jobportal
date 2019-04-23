<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
  	protected $table = "tbl_user_detail";
    public $timestamps = true;
    protected $fillable = [
        'id', 
        'application_id', 
        'full_name', 
        'gender', 
        'passport_number', 
        'religion', 
        'citizenship',
        'marital_status',
        'race', 
        'nationality', 
        'driving_licence', 
        'cns', 
        'home_address', 
        'home_tel',
        'dob_place',
        'pass_type',
        'pass_issued',
        'emergency_name',
        'emergency_tel',
        'emergency_address'
    ];
   
   
}
