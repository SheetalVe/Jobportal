<?php

namespace App\Http\Controllers\frontend; 
use App\Userdetail;
use App\User;
use App\Models\frontend\YoutubeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;
class ExportUserprofileController extends Controller
{
    public function index()
    {
        return view('frontend.export.exportuserprofile');
    } 
    public function import(Request $request)
    {   //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        )); 
        if($request->hasFile('file'))
        {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv")
            { 
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count())
                { 
                    foreach ($data as $key => $value)
                    {
                        $insertData=User::create([
                            'email' => $value->email, 
                            'contact_no' =>$value->telephone,      
                            'address'=> $value->location,           
                        ]);
                        $id=$insertData->id;
                        $userdetaildata=Userdetail::create([
                            'userid' => $id,
                            'website' => $value->website,
                            'company_name' => $value->companyname,            
                            'description' => $value->description,            
                            'query' => $value->missionstatement,            
                            'slogan' => $value->slogan,            
                            'facebook' => $value->facebook,            
                            'linkdin' => $value->linkdin,            
                            'sector' => $value->sector1.",".$value->sector2.",".$value->sector3,            
                            'google' => $value->google,                               
                        ]);                        
                        YoutubeModel::create([              
                            'user_id' =>$id ,
                        'youtube_url' =>$value->youtube
                        ]);
                        if ($insertData) 
                        {
                            Session::flash('success', 'Your Data has successfully imported');
                        }
                        else
                        {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    } 
                } 
                return back(); 
            }
            else
            {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    } 
}
