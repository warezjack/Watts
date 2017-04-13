<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Emotion as Emotions;
use App\Category as Categories;
use App\Behaviour as Behaviours;
use View;
use Redirect;
use Alert;
use Illuminate\Support\Facades\Input;

class ComposeController extends Controller
{

	public function __construct() {
		$this->middleware('auth', ['except' => 'logout']);
	}


    public function add(Request $request) {
    	$behaviour = new Behaviours();
    	$behaviour->assessment_name = $request->get('assessment_name');

    	$getAllCategories = $request->get('category');

    	if(empty($getAllCategories)) {
    		$behaviour->has_categories = 0;
    	}
    	else {
    		$behaviour->has_categories = 1;
    		$categoryTypeId = $this->saveCategories($getAllCategories);
    		$behaviour->category_id = $categoryTypeId;
    	}

  		$getAllEmotions = $request->get('emotion');
  		if(empty($getAllEmotions)) {
  			$behaviour->has_emotions = 0;
  		}
  		else {
  			$behaviour->has_emotions = 1;
  			$emotionTypeId = $this->saveEmotions($getAllEmotions);
  			$behaviour->emotion_id = $emotionTypeId;
  		}

  		$behaviour->save();
  		return redirect('compose');
    }

    public function saveCategories($categories) {
    	$categoryType = new Categories();

    	$categoryType->has_sports = 0;
    	$categoryType->has_medicine = 0;
    	$categoryType->has_computers = 0;
    	$categoryType->has_politics = 0;
    	$categoryType->has_religion = 0;
    	$categoryType->has_electronics = 0;
    	$categoryType->has_space = 0;
    	$categoryType->has_motorcycles = 0;

    	foreach ($categories as $category) {
    		switch($category) {
    			case 'Sports':
    				$categoryType->has_sports = 1;
    				break;
    			case 'Medicine':
    				$categoryType->has_medicine = 1;
    				break;
    			case 'Computers':
    				$categoryType->has_computers = 1;
    				break;
    			case 'Politics':
    				$categoryType->has_politics = 1;
    				break;
    			case 'Religion':
    				$categoryType->has_religion = 1;
    				break;
    			case 'Electronics':
    				$categoryType->has_electronics = 1;
    				break;
    			case 'Space':
    				$categoryType->has_space = 1;
    				break;
    			case 'Motorcycles':
    				$categoryType->has_motorcycles = 1;
    				break;
    		}
    	}

    	$categoryType->save();
    	return $categoryType->id;
    }

    public function saveEmotions($emotions) {
    	$emotionType = new Emotions();

    	$emotionType->has_fear = 0;
    	$emotionType->has_joy = 0;
    	$emotionType->has_love = 0;
    	$emotionType->has_disgust = 0;
    	$emotionType->has_sadness = 0;
    	$emotionType->has_surprise = 0;
    	$emotionType->has_anger = 0;

    	foreach ($emotions as $emotion) {
    		switch ($emotion) {
	    		case 'Fear':
	    			$emotionType->has_fear = 1;
	    			break;
	    		case 'Joy':
	    			$emotionType->has_joy = 1;
	    			break;
	    		case 'Love':
	    			$emotionType->has_love = 1;
	    			break;
	    		case 'Disgust':
	    			$emotionType->has_disgust = 1;
	    			break;
	    		case 'Sadness':
	    			$emotionType->has_sadness = 1;
	    			break;
	    		case 'Surprise':
	    			$emotionType->has_surprise = 1;
	    			break;
	    		case 'Anger':
	    			$emotionType->has_anger = 1;
	    			break;
	    	}
    	}

    	$emotionType->save();
    	return $emotionType->id;
    }

    public function index() {
    	$behaviours = Behaviours::all();
      return view('compose', compact('behaviours'));
    }

    public function destroy($id) {
    	$behaviour = Behaviours::find($id);
    	$emotionType = Emotions::find($behaviour->emotion_id);
    	$categoryType = Categories::find($behaviour->category_id);

    	$behaviour->delete();
      $emotionType->delete();
    	$categoryType->delete();

      // redirect
      notify()->flash('Assessment Test Successfully Deleted', 'success');
      return redirect()->to('compose');
    }

    public function edit($id) {
    	$behaviour = Behaviours::find($id);

    	if(!is_null($behaviour->emotion_id)) {
    		$emotionType = Emotions::find($behaviour->emotion_id);
    	}

    	if(!is_null($behaviour->category_id)) {
    		$categoryType = Categories::find($behaviour->category_id);
    	}
      return View::make('compose.edit')->with(compact('behaviour', 'emotionType', 'categoryType'));
    }

    public function show($id) {
    	$behaviour = Behaviours::find($id);

    	if(!is_null($behaviour->emotion_id)) {
    		$emotionType = Emotions::find($behaviour->emotion_id);
    	}

    	if(!is_null($behaviour->category_id)) {
    		$categoryType = Categories::find($behaviour->category_id);
    	}
        // show the view and pass the nerd to it
        return View::make('compose.show')->with(compact('behaviour', 'emotionType', 'categoryType'));
    }

    public function update($id) {
    	$behaviour = Behaviours::find($id);

    	if(!is_null($behaviour->emotion_id)) {
    		$emotionType = Emotions::find($behaviour->emotion_id);
    	}

    	else {
    		$emotionType = new Emotions();
   			$behaviour->has_emotions = 1;
    	}

    	$emotionTypeId = $this->setEmotions($emotionType);

    	if(!is_null($behaviour->category_id)) {
    		$categoryType = Categories::find($behaviour->category_id);
    	}

    	else {
    		$categoryType = new Categories();
    		$behaviour->has_categories = 1;
    	}

    	$categoryTypeId = $this->setCategories($categoryType);

      $behaviour->assessment_name = Input::get('assessment_name');
    	$behaviour->emotion_id = $emotionTypeId;
    	$behaviour->category_id = $categoryTypeId;
    	$behaviour->save();

    	//redirect
    	notify()->flash('Assessment Test Successfully Updated', 'success');
      return redirect()->to('compose');
    }

    public function setCategories($categoryType) {
    	$categoryType->has_sports = empty(Input::get('has_sports')) ? 0 : 1;
    	$categoryType->has_medicine = empty(Input::get('has_medicine')) ? 0 : 1;
    	$categoryType->has_computers = empty(Input::get('has_computers')) ? 0 : 1;
    	$categoryType->has_politics = empty(Input::get('has_politics')) ? 0 : 1;
    	$categoryType->has_religion = empty(Input::get('has_religion')) ? 0 : 1;
    	$categoryType->has_electronics = empty(Input::get('has_electronics')) ? 0 : 1;
    	$categoryType->has_space = empty(Input::get('has_space')) ? 0 : 1;
    	$categoryType->has_motorcycles = empty(Input::get('has_motorcycles')) ? 0 : 1;
    	$categoryType->save();
    	return $categoryType->id;
    }

    public function setEmotions($emotionType) {
    	$emotionType->has_fear = empty(Input::get('has_fear')) ? 0 : 1;
    	$emotionType->has_joy = empty(Input::get('has_joy')) ? 0 : 1;
    	$emotionType->has_love = empty(Input::get('has_love')) ? 0 : 1;
    	$emotionType->has_disgust = empty(Input::get('has_disgust')) ? 0 : 1;
    	$emotionType->has_sadness = empty(Input::get('has_sadness')) ? 0 : 1;
    	$emotionType->has_surprise = empty(Input::get('has_surprise')) ? 0 : 1;
    	$emotionType->has_anger = empty(Input::get('has_anger')) ? 0 : 1;
    	$emotionType->save();
    	return $emotionType->id;
    }
}
