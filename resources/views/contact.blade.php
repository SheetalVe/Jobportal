@extends('layouts.app')
@section('content')
    <section class="connect_section profile">
    @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
        <div class="container">
                <div class="col-md-12">
                        <div class="profile_head">
                                <h2>Application Form </h2>
                            </div>
                            <form method="post" action="{{url('items')}}">
                            {{csrf_field()}}
                            <div class="mem_data">
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Position Applied*:</label>
                                        <input type="text" name="position_applied" placeholder="Position Applied" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Expected Salary*:</label>
                                        <input type="text" name="exp_sal" placeholder="Expected Salary" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>When are you available to join the company?*:</label>
                                        <input type="text" name="when_join_company" placeholder="When are you available to join the company" class="form-control" required="required" aria-required="true" >
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Referral Source*:</label>
                                        <select class="form-control" name="referral_source" required="required" aria-required="true" >
                                        <option value="1" selected="selected">Advertisement</option>
                                        <option value="2">Employee</option>
                                        <option value="3">Employment Agency</option>
                                        <option value="4">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Name of Source (If applicable)</label>
                                        <input type="text" name="name_of_source" placeholder="Name of Source (If applicable)" class="form-control" required="required" aria-required="true">
                                    </div>   
                                
                                </div>
                                </div>
                                <div class="profile_head">
                                    <h2>Personal Record</h2>
                                </div>
                                <div class="mem_data">

                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Full Name (As in NRIC / Passport)*:</label>
                                        <input type="text" name="full_name" placeholder="Full Name (As in NRIC / Passport)" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>IC/Passport Number *:</label>
                                        <input type="text" name="passport_number" placeholder="IC/Passport Number" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Gender*:</label>
                                        <select class="form-control" name="gender" required="required" aria-required="true">
                                        <option value="female" selected="selected">Female </option>
                                        <option value="male">Male</option>
                                        
                                        </select>
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Religion*:</label>
                                        <select class="form-control" name="religion" required="required" aria-required="true">
                                        <option value="1" selected="selected">Advertisement</option>
                                        <option value="2">Employee</option>
                                        <option value="3">Employment Agency</option>
                                        <option value="4">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Citizenship*:</label>
                                        <input type="text" name="citizenship" placeholder="Citizenship" class="form-control" required="required" aria-required="true" >
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Marital Status*:</label>
                                        <select class="form-control" name="marital_status" required="required" aria-required="true">
                                        <option  selected="true" id="1">Single</option>
                                        <option  value="2">Married</option>
                                        <option value="3">Divorced</option>
                                        <option  value="4">Separated</option>
                                        <option  value="5">Widowed</option></select>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Race*:</label>
                                        <input type="text" name="race" placeholder="Race" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Nationality*:</label>
                                        <input type="text" name="nationality" placeholder="Nationality" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                    <div class="form-group col-md-5">
                                        <label>Driving Licence*:</label>
                                        <select class="form-control" name="driving_licence" required="required" aria-required="true">
                                        <option value="Class 2" selected="selected">Class 2</option>
                                        <option value="Class 3">Class 3</option>
                                        <option value="Class 4">Class 4</option>
                                        <option value="Other">Other</option>
                                        <option value="N/A">N/A</option>
                                        </select>
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Completed National Service*:</label>
                                        <select class="form-control" name="cns" required="required" aria-required="true">
                                        <option value="Yes" selected="selected">Yes</option>
                                        <option value="No">No</option>
                                        <option value="Extempted">Extempted</option>
                                        <option value="Not Liable">Not Liable</option>
                                        </select>
                                </div>
                                <br/>
                                <div class="">
                                    <div class="form-group col-md-5">
                                        <label>Home Address*:</label>
                                        <input type="text" name="home_address" placeholder="Home Address" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Telephone (Home) *:</label>
                                        <input type="text" name="home_tel" placeholder="Telephone (Home)" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                    
                                <br/>
                                <div class="">
                                    <div class="form-group col-md-5">
                                        <label>Email address * :</label>
                                        <input type="text" name="email_id" placeholder="Email address" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Place / Date of Birth *:</label>
                                        <input type="text" name="dob_place" placeholder="Place / Date of Birth" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                    
                                <br/>
                                <div class="">
                                    <div class="form-group col-md-5">
                                        <label>Pass Type (E.g. EP, S-Pass, WP, DP, LPTV+, etc) *:</label>
                                        <input type="text" name="pass_type" placeholder="Pass Type (E.g. EP, S-Pass, WP, DP, LPTV+, etc)" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Pass Issued By (E.g. MOM, ICA) *:</label>
                                        <input type="text" name="pass_issued" placeholder="Pass Issued By (E.g. MOM, ICA) " class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                    
                                <br/>
                                <div class="">
                                    <div class="form-group col-md-5">
                                        <label>Interest *:</label>
                                        <input type="text" name="interest" placeholder="Interest" class="form-control" required="required" aria-required="true">
                                    </div>   
                                
                                </div>
                                <br/>
                                In case of emergency person to be contacted:


                                <div class="">
                                    <div class="form-group col-md-5">
                                        <label>Name*:</label>
                                        <input type="text" name="emergency_name" placeholder="Name" class="form-control" required="required" aria-required="true">
                                    </div>   
                                    <div class="form-group col-md-5">
                                        <label>Telephone *:</label>
                                        <input type="text" name="emergency_tel" placeholder="Telephone" class="form-control" required="required" aria-required="true">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group col-md-10">
                                        <label>EMergency Address*:</label>
                                        <textarea name="emergency_address" placeholder="Emergency Address" class="form-control" required="required" aria-required="true"></textarea>
                                    </div>   
                                  
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary newbutton" id="btnContactUs">Submit Data</button>
                            </div> 
                        </form>                      
                </div>
            </div>
        </div>
    </section>

@endsection

