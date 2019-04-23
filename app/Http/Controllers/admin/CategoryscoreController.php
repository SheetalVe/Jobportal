	<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\Question;
use App\Models\admin\Category_score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryscoreController extends Controller
{
    
    #For View Page
	public function index(){
		$question= Question::all();
		$allquestion=array();
		foreach($question as $q){
			$allquestion[$q->question_id]=$q->question_name;
		}
		$page_title = 'Add Category Score';
        $btnName = 'Add Score';

        return view('admin.score.add-score', compact('btnName','page_title','allquestion'));

	}

	#Add Category
	public function addsScore(Request $request){
       //echo "<pre>"; print_r($request->all()); exit;
       
        /*$this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);*/
        //create a quiz type
        $question = Category_score::addScore($request->all());

        //check quiz type update or save
        /*if($request->question_id){
            \Session::flash('errorMsg','Quiz type updated successfully.');
            return redirect()->route('quiztypelist', ['redirect'=>'true']);
        }*/
        if($question == true){
            return redirect()->intended('public/admin/')->with('status', 'Category type added successfully.');
        }else{
            return redirect()->intended('public/admin/')->with('status', 'Category added failed, due to some reason!');
        }
    }



}
