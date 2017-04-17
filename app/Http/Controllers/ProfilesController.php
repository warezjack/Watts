<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Auth;
use App\User as Users;
use App\EmotionValue as EmotionValue;
use App\UsersDetail as UsersDetails;

class ProfilesController extends Controller
{
    public function fetch() {
      $userObject = new Users();
      $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
      $users = $userObject->getUserCompletedAssessments($usersDetails['organisation_name']);
			return View::make('profiles')->with(compact('users'));
    }

    public function years(Request $request) {
      $emotionValue = new EmotionValue;
      $candidateId = $request->get('candidateId');
      $years = $emotionValue->retrieveYears($candidateId);
      echo json_encode($years);
    }

    public function months(Request $request) {
      $emotionValue = new EmotionValue;
      $year = $request->get('year');
      $candidateId = $request->get('candidateId');
      $months = $emotionValue->retrieveMonths($candidateId, $year);
      
      //total document in a year
      $total = $emotionValue->totalDocumentYears($candidateId, $year);
      echo json_encode($months);
    }
}
