
@extends('layouts.admin')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
<div class="modal fade" id="myModal" role="dialog" style="max-width: 300px;margin: 16.75rem auto;">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">    
      <div class="modal-header">        
        <h6>Rate User</h6>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body">
            <ul> 
                <li>
                    <span class="p_result">
                        <div class="star_rating">
                        <?php $reqid=$userdata->reqid;?>
                        <?php $authid=Auth::user()->id;?>
                        @for($i=1;$i<=5;$i++)
                        <a href="javascript:void(0)" onclick=rating({{$i}},{{$reqid}},{{$authid}});><span class="fa fa-star ratestar" id="rate{{$i}}"></span></a>
                        @endfor
                        </div>
                    </span>
                </li>
            </ul>
        </div>          
      </div>      
    </div>
  </div>
    <section class="connect_section profile">
        <div class="container">
            <div class="row">  
                <div class="col-md-12">
                    <div class="profile-score" >
                        <a href="#" class="brand_logo">
                            <img src="{{ (isset($userdata->companylogo) && $userdata->companylogo != '' ) ?  'http://dev2.noogah.eu/public/images/companylogo/'. $userdata->companylogo  : 'http://dev2.noogah.eu/public/images/companylogo/logo-dummy.png' }}" alt="">
                        </a>               
                        <ul>   
                            <li><i class="fa fa-trophy"></i> {{session()->get('locale_data')['transparency_score']}} <span class="p_result">842</span></li>
                            <li><i class="fa fa-star"></i>  {{session()->get('locale_data')['ratings']}} 
                                <span class="p_result">
                                    <div class="star_rating">
                                   <!-- <a href="#"><span class="fa fa-star checked"></span></a>-->
                                    @for($i=1;$i<=5;$i++)
                                        <a href="#"><span class="fa fa-star  @if(isset($rating ) && $rating >= $i) checked @endif "></span></a>  
                                    @endfor 
                                    </div>
                                </span>
                            </li>
                            <li><i class="fa fa-signal"></i> {{session()->get('locale_data')['dev_stage']}}<span class="p_result"> {{  isset( $userdata->type_of_company) && $userdata->type_of_company == '1'  ? "Start-up" :  isset($userdata->type_of_company) && $userdata->type_of_company == '2' ? "Growth" :  isset($userdata->type_of_company) && $userdata->type_of_company == '3' ? "International Development" :  isset($userdata->type_of_company) && $userdata->type_of_company == '4' ? "Restructuring" :  isset($userdata->type_of_company) && $userdata->type_of_company == '5' ? "Medium Company" :  isset($userdata->type_of_company) && $userdata->type_of_company == '6' ? "Large Company" : "Start up"  }}</span></li>
                            <li><i class="fa fa-users"></i>  {{session()->get('locale_data')['total_followers']}}<span class="p_result">{{  isset( $userdata->totalfollow) && $userdata->totalfollow != ''  ? $userdata->totalfollow : "0"  }}</span></li>
                        </ul>
                    </div> 
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="profile-sdetail">
                        <ul class="mem_social">
                            @if(isset($userdata->facebook) && $userdata->facebook != '')  <li><a href="{{$userdata->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li> @endif
                            @if(isset($userdata->linkedin) && $userdata->linkedin != '')    <li><a href="{{$userdata->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li> @endif
                            @if(isset($userdata->google) && $userdata->google != '')     <li><a href="{{$userdata->google}}" target="_blank"><i class="fa fa-google-plus"></i></a></li> @endif
                            @if(isset($userdata->twitter) && $userdata->twitter != '')     <li><a href="{{$userdata->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li> @endif
                        </ul> 
                        <a href="#" target="_blank" class="web_link">{{$userdata->wesite}}</a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-10"> 
                    <div class="profile_quote">  
                       <div class="profile_data"> 
                            <div class="data-group">
                            <h6>{{$userdata->company_name}} </h6>
                            <p>{{  isset( $userdata->slogan) && $userdata->slogan != ''  ? $userdata->slogan : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"  }}</p>
                            </div>               
                        </div>               
                    </div>
                    <ul class="btn_list">
                        @if(isset($userdata->userfollowcount ) && $userdata->userfollowcount >= 1)
                        <li><a href="javascript:void(0);"  style="background-color: #4fc180;"> {{session()->get('locale_data')['followed']}}<i class="fa fa-user" style="float: right;margin: 4px 0;"></i></a></li>
                        @else 
                            <li><a href="javascript:void(0);" onclick="userfollow({{ $userdata->reqid}});"> {{session()->get('locale_data')['follow']}} <i class="fa fa-users" style="float: right;margin: 4px 0;"></i></a></li>
                        @endif 
                        @if(isset($rating ) && $rating >= 1)
                            <li><a href="javascript:void(0);"  data-toggle="modal" data-target="#myModal" style="background-color: #4fc180;">{{session()->get('locale_data')['rated']}} <i class="fa fa-star" style="float: right;margin: 4px 0;"></i>
                            <span style="loat: right;font-size: 14px;margin: 2px 4px;">({{  isset( $userratingcount->rating) && $userratingcount->rating != ''  ? $userratingcount->rating : "0"  }})</span></a></li> 
                        @else 
                            <li><a href="javascript:void(0);"   data-toggle="modal" data-target="#myModal">{{session()->get('locale_data')['rate']}}  <i class="fa fa-star-o" style="float: right;margin: 4px 0;"></i></a></li>  
                        @endif                                                
                            @if(isset($connectprofile) && $connectprofile->status == 'pending' ) <li><a href="javascript:void(0);">{{session()->get('locale_data')['pending']}}</a> </li>  
                            @elseif(isset($connectprofile) && $connectprofile->status == 'accept' )<li><a href="javascript:void(0);" style="background-color: #4fc180;">{{session()->get('locale_data')['connected']}}</a> </li>     
                            <li>  <a href="{{ route('IssueCertification') }}" style="background-color: #4fc180;" target="_blank">{{session()->get('locale_data')['certify']}}</a></li>         
                            @else
                            <li>  <a href="{{ route('connect', [ $userdata->reqid ]) }}" > {{session()->get('locale_data')['connect']}}</a></li>                            
                            @endif                        
                        @if(isset($connectprofile) && $connectprofile->status == 'accept' )                       
                            @if(isset($connectprofile) && $connectprofile->isdocpermission == 'no' ) 
                            <li><a href="{{ route('docrequest', [ $userdata->reqid ,'pending']) }}"> {{session()->get('locale_data')['req_info']}}</a></li>                          
                            @elseif(isset($connectprofile) && $connectprofile->isdocpermission == 'pending' ) 
                            <li><a href="javascript:void(0);" >{{session()->get('locale_data')['pending']}} </a></li>
                            @else
                            <li> <a href="javascript:void(0);" style="background-color: #4fc180;">{{session()->get('locale_data')['access_info']}}</a></li> 
                            @endif
                        @endif
                    </ul>                           
                </div>                 
                <div class="col-md-7 col-sm-6">
                    <div class="youtube_frame" id="youtube">
                    <iframe frameborder="0" height="350px" width="100%" src="https://youtube.com/embed/M-0sPfmeygI?autoplay=1&controls=0&showinfo=0&autohide=1"></iframe>
                    </div>
                    <div class="additional_link owl-carousel">  
                    <?php $i=1;?>           
                            @foreach ($Youtube as $Youtube)      
                            @if($Youtube != "")                          
                                <div class="item"><a href="javascript:void(0);" onclick="changeyoutube('{{$Youtube}}')"><img src="https://img.youtube.com/vi/{{$Youtube}}/sddefault.jpg" width="80px"></a></div>
                                @endif
                            @endforeach  
                    </div>
                </div>
                <div class="col-md-5 col-sm-6">
                    <div class="graph_progress">
                        <div class="title">
                            <h5>{{session()->get('locale_data')['key_stats']}}</h5>
                        </div>
                        @foreach ($quiz as $key=>$value)                                
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$value}}"
                            aria-valuemin="0" aria-valuemax="100" style="width:{{$value}}%">
                            {{$value}}% Complete ({{$key}} )
                            </div>
                        </div>
                        @endforeach  
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="profile_data"> 
                        <div class="data-group">
                            <h6>{{session()->get('locale_data')['mission_statement']}} </h6>
                            <p>{{$userdata->query}}</p>
                        </div>
                        <div class="data-group">
                            <h6>{{session()->get('locale_data')['decription']}}</h6>
                            <p>{{$userdata->description}}</p>
                        </div>
                      
                        @if(isset($connectprofile) && $connectprofile->status == 'pending' )
                        @elseif(isset($connectprofile) && $connectprofile->status == 'accept' )    
                        <div class="data-group">
                            <h6>{{session()->get('locale_data')['doc_vault']}} </h6>
                            <ul>
                            @foreach ($userdoc as $userdoc) 
                                <li> {{$userdoc->doctype}} @if(isset($connectprofile) && $connectprofile->isdocpermission == 'yes' )<a href="{{asset('images/document/').'/'.$userdoc->docname }}" target="_blank"> <button class="download_btn">{{session()->get('locale_data')['download']}} </button></a>@endif</li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                        @endif     
                        <div class="data-group">
                            <h6>{{session()->get('locale_data')['people']}}</h6>
                            <div class="profile-pic">
                                <img align="left" class="mem-image-profile thumbnail" src="{{ $userdata->profilepic != ''  ?   $userdata->profilepic  : $userdata->linkedin_id != '' ? asset($userdata->profilepic) :  asset('img/9.jpeg')  }}" alt="Profile image example"/>                                
                            </div>
                            <span class="mem_name">{{$userdata->first_name}} {{$userdata->last_name}}</span> 
                            <p>{{$userdata->summary}} </p>
                            <div class="linkedin-conn">
                                <div class="profile-pic">
                                    <img align="left" class="mem-image-profile thumbnail" src="http://dev2.noogah.eu/public/img/LinkedIn_logo.png">                                
                                </div>
                                <ul class="l_profile">
                                @if($linkdin_people->count() == 0)
                                <li>{{session()->get('locale_data')['no_result_found']}}</li>
                                @else
                                @foreach ($linkdin_people as $linkdin_people) 
                                    <li><a href="{{$linkdin_people->linkdinurl}}" target="_blank">{{$linkdin_people->linkdinname}}</a></li>
                                @endforeach
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>                    
                </div>                
            </div>
        </div>
    </section> 
@endsection 

