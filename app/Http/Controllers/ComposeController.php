<?php

namespace App\Http\Controllers;
use Auth;

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
			$behaviour->user_id = Auth::user()->id;
  		$behaviour->save();
  		return redirect('compose');
    }

    public function saveCategories($categories) {
    	$categoryType = new Categories();

    	$categoryType->is_positive = 0;
    	$categoryType->is_negative = 0;
    	$categoryType->is_offensive = 0;

    	foreach ($categories as $category) {
    		switch($category) {
    			case 'Positive':
    				$categoryType->is_positive = 1;
    				break;
    			case 'Negative':
    				$categoryType->is_negative = 1;
    				break;
    			case 'Offensive':
    				$categoryType->is_offensive = 1;
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
    	$behaviours = Behaviours::all()->where('user_id', Auth::user()->id);
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
    	$categoryType->is_positive = empty(Input::get('is_positive')) ? 0 : 1;
    	$categoryType->is_negative = empty(Input::get('is_negative')) ? 0 : 1;
    	$categoryType->is_offensive = empty(Input::get('is_offensive')) ? 0 : 1;
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
