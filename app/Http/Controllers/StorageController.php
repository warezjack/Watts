<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\CandidateAssessment as CandidateAssessment;
use App\EmotionValue as EmotionValue;
use App\PolarityValue as PolarityValue;
use App\PredictedValue as PredictedValue;
use App\PredictedPvalue as PredictedPvalue;
use App\UsersDetail as UsersDetails;
use App\TwitterStatus as TwitterStatus;
use View;
use Auth;

class StorageController extends Controller
{
  public function index() {
    $userObject = new Users();
    $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
    $usersDownloadedData = $userObject->getTwitterAndAssessmentStatus($usersDetails['organisation_name']);
    return View::make('storage')->with(compact('usersDownloadedData'));
  }

  public function destroyCSV($twitterId) {

    $twitterStatus = TwitterStatus::find($twitterId);
    unlink($twitterStatus->csv_location);
    $twitterStatus->delete();

    notify()->flash('Candidate Data file has been successfully deleted', 'success');
    return redirect()->to('storage');
  }

  public function deleteRecords($userId) {
    $emotionObject = new EmotionValue();
    $candidateObject = new CandidateAssessment();
    $polarityObject = new PolarityValue();
    $predictedValueObject = new PredictedValue();
    $predictedPValueObject = new PredictedPvalue();

    $emotionObject->removeUserEntries($userId);
    $polarityObject->removeUserEntries($userId);
    $predictedValueObject->removeUserEntries($userId);
    $predictedPValueObject->removeUserEntries($userId);
    $candidateObject->removeCandidateRecord($userId);

    notify()->flash('Candidate\'s records has been successfully deleted', 'success');
    return redirect()->to('storage');
  }
}
