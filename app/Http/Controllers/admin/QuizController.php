<?php
/*
 * @Author: Thomas
 * @QuizController
 * @Date: 2018-08-29
 * @Last Modified by: Thomas
 * @Last Modified: 2018-08-29
 */

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\QuizType;
use App\Models\admin\Quiz;

class QuizController extends Controller
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
       //default function
    }

    /**
    *
    *Function addQuizTypeView
    * 
    *load quiz type view
    *@param ()()
    *@return ()()
    */
    public function addQuizTypeView(){

        $page_title = 'Add Quiz Type';
        $btnName = 'Add Type';
        return view('admin.quiz.add-quiz-type', compact('btnName','page_title'));
    }

    /**
    *
    *Function addQuizType
    * 
    *add quiz type goes here
    *@param (array)($request)
    *@return (boolean)(true or false)
    */
    public function addQuizType(Request $request){

       
        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        //create a quiz type
        $quiz = QuizType::addQuizType($request);

        //check quiz type update or save
        if($request->quizTypeId){
            \Session::flash('errorMsg','Quiz type updated successfully.');
            return redirect()->route('quiztypelist', ['redirect'=>'true']);
        }
        if($quiz == true){
            return redirect()->intended('admin/add-quiz-type-view')->with('status', 'Quiz type added successfully.');
        }else{
            return redirect()->intended('admin/add-quiz-type-view')->with('status', 'Quiz added failed, due to some reason!');
        }
    }

    /**
    *
    *Function addQuizView
    * 
    *load quiz view
    *@param ()()
    *@return ()()
    */
    public function addQuizView(){

        //get quiz type
        $quizTypeArr = self::getQuizType();
        $page_title = 'Add Quiz';
        $btnName = 'Add Quiz';
        return view('admin.quiz.add-quiz', compact('btnName','page_title', 'quizTypeArr'));
    }

    /**
    *
    *Function addQuiz
    * 
    *add quiz goes here
    *@param (array)($request)
    *@return (boolean)(true or false)
    */
    public function addQuiz(Request $request){

        //dd($request->all()); die;
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'close_date' => 'required',
            'answer_order_type' => 'required',
            'answer_option_listing' => 'required'
        ]);
        
        //create a quiz
        $quiz = Quiz::addQuiz($request);

        //check quiz update or save
        if($request->quiz_id){
            \Session::flash('errorMsg','Quiz updated successfully.');
            return redirect()->route('quizlist', ['redirect'=>'true']);
        }

        if($quiz == true){
            return redirect()->intended('admin/add-quiz-view')->with('status', 'Quiz added successfully.');
        }else{
            return redirect()->intended('admin/add-quiz-view')->with('status', 'Quiz added failed, due to some reason!');
        }
    }

    /**
    * Function getQuizType
    *
    * getQuizType here
    *
    * @param () ()
    * @return (array) ($typeArr)
    */
    public static function getQuizType(){
        
        //init variables
        $typeArr = [];
        $typeArr = DB::table('quiz_types')->pluck('name', 'id');
        return $typeArr;  
    }

    /**
    *
    *Function quizTypeList
    * 
    *quiz type list
    *@param ()()
    *@return ()()
    */
    public function quizTypeList(){
        
        //get quiz type here
        $quizTypeArr = QuizType::getQuizType()->toArray();
        $btnName = 'Add Type';
        $page_title = 'Quiz Type List';
        return view('admin.quiz.quiz-type-list', compact('page_title', 'quizTypeArr', 'btnName'));
    }


    /**
    *
    *Function quizList
    * 
    *quiz list goes here
    *@param ()()
    *@return ()()
    */
    public function quizList(){
        
        //get quiz type here
        $quizArr = Quiz::quizList()->toArray();
        $btnName = 'Add Quiz';
        $page_title = 'Quiz List';
        return view('admin.quiz.quiz-list', compact('page_title', 'quizArr', 'btnName'));
    }

    /**
    *
    *Function editQuizType
    * 
    *edit quiz type goes here
    *@param (array)($request)
    *@return (boolean)(true or false)
    */
    public function editQuizType(Request $request){
        if($request->id){
            $quizTypeArr = QuizType::getQuizType($request->id)->toArray();
            //echo "<pre>"; print_r($quizTypeArr); die;
            $page_title = 'Update Quiz Type';
            $btnName = 'Update Type';
            return view('admin.quiz.update-quiz-type', compact('btnName','page_title','quizTypeArr'));
        }
    }

    /**
    *
    *Function editQuiz
    * 
    *edit quiz goes here
    *@param (array)($request)
    *@return (boolean)(true or false)
    */
    public function editQuiz(Request $request){
        if($request->id){

            //get quiz type array for drop down
            $quizTypeArr = self::getQuizType();

            //get quiz details
            $quizArr = Quiz::quizList($request->id)->toArray();
            


            //form static content
            $page_title = 'Update Quiz';
            $btnName = 'Update Type';
            return view('admin.quiz.update-quiz', compact('btnName','page_title','quizArr', 'quizTypeArr'));
        }
    }

    public function delete_quiz(Request $request){
        if(!empty($request->id)){
            $result= Quiz::where('quiz_id',$request->id)->delete();
            if(!empty($result)){
                return redirect()->intended('admin/quiz-list')->with('status', 'Quiz deleted successfully.');
            }else{
                return redirect()->intended('admin/quiz-list')->with('status', 'Error!!, Please try again');
            }
            
        }   
        
    }
}
