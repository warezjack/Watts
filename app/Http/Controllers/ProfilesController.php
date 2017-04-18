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
      $specificDocs = $emotionValue->specificDocumentYears($candidateId, $year);

      $emotions = array();
      $emotions_values = array();

      foreach ($specificDocs as $doc) {
        $categoryPerc = ($doc->count / $total) * 100;
        array_push($emotions_values, $categoryPerc);
        array_push($emotions, $doc->emotion);
      }
      echo json_encode(array($months, $emotions, $emotions_values));
    }

    public function yearsWiseData(Request $request) {
      $emotionValue = new EmotionValue;
      $candidateId = $request->get('candidateId');
      $allYearsDocs = $emotionValue->allDocumentYears($candidateId);
      $emotions_names = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");

      $year = array();
      foreach ($allYearsDocs as $doc) {
        array_push($year, $doc->year);
      }
      $unique_year = array_unique($year);

      foreach($unique_year as $year) {
        $emotions[$year] = array();
        $emotions_values[$year] = array();
        $total = $emotionValue->totalDocumentYears($candidateId, $year);
        foreach($allYearsDocs as $doc) {
          if($year == $doc->year) {
            $categoryPerc = ($doc->count / $total) * 100;
            array_push($emotions[$year], $categoryPerc);
            array_push($emotions_values[$year], $doc->emotion);
          }
        }
      }
      foreach ($unique_year as $year) {
        $diffArray = array_diff($emotions_names, $emotions_values[$year]);
        foreach ($diffArray as $arr) {
          array_push($emotions_values[$year], $arr);
        }
        sort($emotions_values[$year]);
        foreach($diffArray as $key => $val) {
          array_splice($emotions[$year], $key, 0, 0);
        }
      }
      echo json_encode(array($unique_year, $emotions, $emotions_values));
    }
}
