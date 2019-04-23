<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserDetail;
use App\Repositories;

class ApplicationForm extends Model
{
  	protected $table = "tbl_application_form";
    public $timestamps = true;
    protected $fillable = [
        'id', 
        'genrated_id',
        'position_applied', 
        'exp_sal', 
        'when_join_company', 
        'referral_source', 
        'name_of_source', 
        'updated_at',
        'created_at',
    ];
    public function userDetailData() {
        return $this->belongsTo(UserDetail::class);
    }
   
}
