<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\PredictFutureBehavior;
use App\User as Users;
use App\PredictedValue as PredictedValue;
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
    $predictedValues = $predict->getPredictedValues($candidateId);
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
      }
      else {
        $emotion = $this->emotionValues($predictedValues);
      }
      echo json_encode(array($distinctYears, $emotion));
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
}
