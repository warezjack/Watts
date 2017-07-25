<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\PredictFutureBehavior;
use App\User as Users;
use App\PredictedValue as PredictedValue;
use App\PredictedPvalue as PredictedPvalue;
use App\EmotionValue as EmotionValue;
use View;
use App\UsersDetail as UsersDetails;

class RegressionController extends Controller
{
  public function fetch() {
    $userObject = new Users();
    $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
    $users = $userObject->getUserCompletedAssessments($usersDetails['organisation_name']);
    return View::make('regression')->with(compact('users'));
  }
  public function predict(Request $request) {
    $candidateId = $request->get('candidateId');
    $predict = new PredictedValue();
    $predictpvalue = new PredictedPvalue();

    $predictedValues = $predict->getPredictedValues($candidateId);
    $predictedpvalues = $predictpvalue->getPredictedPValues($candidateId);
    $distinctYears = $predict->distinctYears($candidateId);

    $em = new EmotionValue();
    $distinctEmotionsYears = $em->distinctYears($candidateId);
    if(count($distinctEmotionsYears) <= 2) {
      echo json_encode(1);
    }
    else {
      if(empty($predictedValues)) {
        $job = (new PredictFutureBehavior($candidateId))->onQueue('Prediction');
  			$this->dispatch($job);
        $emotion = $this->emotionValues($predictedValues);
        $polarity = $this->polarityValues($predictedpvalues);
      }
      else {
        $emotion = $this->emotionValues($predictedValues);
        $polarity = $this->polarityValues($predictedpvalues);
      }
      echo json_encode(array($distinctYears, $emotion, $polarity));
    }
  }
  public function emotionValues($predictedValues) {
    $emotions = ['Anger', 'Disgust', 'Fear', 'Joy', 'Love', 'Sadness', 'Surprise'];
    foreach ($emotions as $em) {
      $emotion[$em] = array();
      foreach($predictedValues as $pred) {
        if($pred->emotion == $em) {
          array_push($emotion[$em], [$pred->year, $pred->predicted_value]);
        }
      }
    }
    return $emotion;
  }

  public function polarityValues($predictedpvalues) {
    $polarities = ['Positive', 'Negative', 'Offensive'];
    foreach($polarities as $p) {
      $polarity[$p] = array();
      foreach($predictedpvalues as $pred) {
        if($pred->polarity == $p) {
          array_push($polarity[$p], [$pred->year, $pred->predicted_value]);
        }
      }
    }
    return $polarity;
  }
}
