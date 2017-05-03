<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\CandidateAssessment as CandidateAssessment;
use App\EmotionValue as EmotionValue;
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
    //trigger HDFS hadoop fs -rm -r OR alluxio fs rm -r command to delete file then remove the record from twitter statuses

    $twitterStatus = TwitterStatus::find($twitterId);
    unlink($twitterStatus->csv_location);
    $twitterStatus->delete();

    notify()->flash('Candidate Data file has been successfully deleted', 'success');
    return redirect()->to('storage');
  }

  public function deleteRecords($userId) {
    $emotionObject = new EmotionValue();
    $candidateObject = new CandidateAssessment();

    $emotionObject->removeUserEntries($userId);
    $candidateObject->removeCandidateRecord($userId);

    notify()->flash('Candidate\'s records has been successfully deleted', 'success');
    return redirect()->to('storage');
  }
}
