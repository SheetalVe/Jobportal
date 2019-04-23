<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Question;
use App\Models\admin\Quiz;
use App\Models\admin\Question_types;
use App\Models\admin\Option;
use App\Models\admin\Choosepersona;
use Image;
use File;
class QuestionController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //public $layout = 'admin.layouts.default';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

        $this->middleware('guest')->except('logout');
    }

    public function index(){
    	echo "fdgdfg"; exit;
       //default function
    }


    public function addQuestionView(Request $request){
    	$page_title = 'Add Question';
        $btnName = 'Submit';
        $quiz= Quiz::all();
        $questionType= Question_types::all();
        $choosePersona= Choosepersona::all(); 
        return view('admin.question.add-question', compact('btnName','page_title','quiz','questionType','choosePersona'));

    }


    #For Add question
 	public function addQuestion(Request $request){
      
        if($request->input('user_type')==1 || $request->input('user_type')==""){
            $this->validate($request, [
            'question_name' => 'required',
            'quiz_id' => 'required',
            'question_type'=>'required',
            'BackgroundTransparencyRating'=>'required|numeric',
            'ProductTransparencyRating'=>'required|numeric',
            'MarketingTransparencyRating'=>'required|numeric',
            'PeopleTransparencyRating'=>'required|numeric',
            'FinanceTransparencyRating'=>'required|numeric',
            'IPTransparencyRating'=>'required|numeric',
            'FundingRequestTransparencyRating'=>'required|numeric',
            'EquityRequestTransparencyRating'=>'required|numeric',
            'DebtRequestTransparencyRating'=>'required|numeric',
            'PeopleRequestTransparencyRating'=>'required|numeric',
            'answer'=>'required'],
                [
                'answer.required' => 'Transparency Value is required field',
                ] 
            );
        }
        
      


        //create a quiz
        $image = $request->file('image');
        $filepath=array();
        if(!empty($image)){ 
            foreach($image as $i){
                $input['imagename'] = microtime().'.'.$i->getClientOriginalExtension();
                $destinationPath = public_path('/images/');
                if (!File::exists($destinationPath))
                {
                    File::makeDirectory($destinationPath, 0777, true, true);
                }           
                $filepath[]= "/images/".$input['imagename'];
                $i->move($destinationPath, $input['imagename']);
            }
        }

        $question = Question::addQuestion($request,$filepath);



        // echo "<pre>";  print_r($filepath); exit;
        //check quiz update or save
        if($request->question_id){
            \Session::flash('errorMsg','Question updated successfully.');
            return redirect()->route('questionlist', ['redirect'=>'true']);
        }



        if($question== true){
            return redirect()->intended('admin/add-question-view')->with('status', 'Question added successfully.');
        }else{
            return redirect()->intended('admin/add-question-view')->with('status', 'Question added failed, due to some reason!');
        }
    
    }

    #For View Question
    public function questionView(){
    	$details= DB::table("question as t1")->join("quizs as t2","t2.quiz_id","=","t1.quiz_id")->select("t1.*","t2.title")->get();
        $btnName = 'Add Question';
        $page_title = 'Question List';
    	return view('admin.question.question-list', compact('details','btnName','page_title'));

    }

    #For Edit Question
     public function editQuestion(Request $request){
		if($request->id){
            $question = Question::where("question_id","=",$request->id)->first();
          	$page_title = 'Update Question Type';
            $btnName = 'Update Type';
            $quiz= Quiz::all();
            $questionType= Question_types::all(); 
            $option= Option::where("question_id","=",$request->id)->get();
           $choosePersona= Choosepersona::all(); 
            return view('admin.question.update-question', compact('btnName','page_title','question','quiz','questionType','option','choosePersona'));
        }
    }

    #Delete a option from a value
    public function delete_question_option(Request $request){
        $result= Option::where('option_id',$request->input('id'))->delete();
        if($result){
            return response()->json(array('success' => 'Option Deleted!!'), 200);
        }else{
            return response()->json(array('success' => 'Option not deleted!!'),200);
        }
    }
    #End here

    #Delete Question
    #Delete a option from a value
    public function delete_question(Request $request){

        if(!empty($request->id)){
            $result= Question::where('question_id',$request->id)->delete();
            if(!empty($result)){
                return redirect()->intended('admin/question-list')->with('status', 'Question deleted successfully.');
            }else{
                return redirect()->intended('admin/question-list')->with('status', 'Error!!, Please try again');
            }
            
        }   
        
    }

}
