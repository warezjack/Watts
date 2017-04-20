<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\EmotionValue as EmotionValue;
use App\UsersDetail as UsersDetails;
use View;
use Auth;

class ComparatorController extends Controller
{
    public function index() {
      $userObject = new Users();
      $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
      $users = $userObject->getUserCompletedAssessments($usersDetails['organisation_name']);
			return View::make('comparator')->with(compact('users'));
    }

    public function yearsWiseComparison(Request $request) {
      $emotionValue = new EmotionValue();
      $firstCandidateId = $request->get('firstCandidateId');
      $secondCandidateId = $request->get('secondCandidateId');
      $pastYearFirstCandidate = $emotionValue->getPastYear($firstCandidateId);
      $pastYearSecondCandidate = $emotionValue->getPastYear($secondCandidateId);

      $getPastYearFirstCandidateDocuments = $emotionValue->getPastYearDocumentCount($firstCandidateId, $pastYearFirstCandidate[0]->year);
      $getPastYearSecondCandidateDocuments = $emotionValue->getPastYearDocumentCount($secondCandidateId, $pastYearSecondCandidate[0]->year);

      $totalFirstCandidateDocs = $emotionValue->totalDocumentYears($firstCandidateId, $pastYearFirstCandidate[0]->year);
      $totalSecondCandidateDocs = $emotionValue->totalDocumentYears($secondCandidateId, $pastYearSecondCandidate[0]->year);

      $firstCandidateEmotionsValues = $this->retrieveEmotionsValues($getPastYearFirstCandidateDocuments, $totalFirstCandidateDocs);
      $secondCandidateEmotionsValues = $this->retrieveEmotionsValues($getPastYearSecondCandidateDocuments, $totalSecondCandidateDocs);
      echo json_encode(array($firstCandidateEmotionsValues, $secondCandidateEmotionsValues));
    }

    public function retrieveEmotionsValues($getPastYearCandidateDocuments, $totalDocuments) {
      $emotionNames = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $emotionNamesFromDoc = array();
      $emotionValues = array();

      foreach($getPastYearCandidateDocuments as $doc) {
          array_push($emotionNamesFromDoc, $doc->emotion);
          array_push($emotionValues, ($doc->count / $totalDocuments) * 100);
      }
      $diffArray = array_diff($emotionNames, $emotionNamesFromDoc);

      foreach($diffArray as $arr) {
        array_push($emotionNamesFromDoc, $arr);
      }

      foreach($diffArray as $key => $val) {
        array_splice($emotionValues, $key, 0, 0);
      }
      return $emotionValues;
    }
}
