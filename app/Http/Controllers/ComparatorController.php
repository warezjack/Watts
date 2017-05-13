<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\EmotionValue as EmotionValue;
use App\PolarityValue as PolarityValue;
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
      $polarityValue = new PolarityValue();

      $firstCandidateId = $request->get('firstCandidateId');
      $secondCandidateId = $request->get('secondCandidateId');
      $firstYearCandidate = $request->get('firstCandidateYear');
      $secondYearCandidate = $request->get('secondCandidateYear');

      $getYearsFirstCandidateDocuments = $emotionValue->getYearsDocumentsCount($firstCandidateId, $firstYearCandidate);
      $getYearsSecondCandidateDocuments = $emotionValue->getYearsDocumentsCount($secondCandidateId, $secondYearCandidate);

      $getYearsFirstCandidatePolarityDocuments = $polarityValue->getYearsDocumentsCount($firstCandidateId, $firstYearCandidate);
      $getYearsSecondCandidatePolarityDocuments = $polarityValue->getYearsDocumentsCount($secondCandidateId, $secondYearCandidate);

      $totalFirstCandidateDocs = $emotionValue->totalDocumentYears($firstCandidateId, $firstYearCandidate);
      $totalFirstCandidatePolarityDocs = $polarityValue->totalDocumentYears($firstCandidateId, $firstYearCandidate);

      $totalSecondCandidateDocs = $emotionValue->totalDocumentYears($secondCandidateId, $secondYearCandidate);
      $totalSecondCandidatePolarityDocs = $polarityValue->totalDocumentYears($secondCandidateId, $secondYearCandidate);

      $firstCandidateEmotionsValues = $this->retrieveEmotionsValues($getYearsFirstCandidateDocuments, $totalFirstCandidateDocs);
      $firstCandidatePolarityValues = $this->retrievePolarityValues($getYearsFirstCandidatePolarityDocuments, $totalFirstCandidatePolarityDocs);

      $secondCandidateEmotionsValues = $this->retrieveEmotionsValues($getYearsSecondCandidateDocuments, $totalSecondCandidateDocs);
      $secondCandidatePolarityValues = $this->retrievePolarityValues($getYearsSecondCandidatePolarityDocuments, $totalSecondCandidatePolarityDocs);
      echo json_encode(array($firstCandidateEmotionsValues, $secondCandidateEmotionsValues, $firstCandidatePolarityValues, $secondCandidatePolarityValues));
    }

    public function monthsWiseComparison(Request $request) {
      $emotionValue = new EmotionValue();
      $polarityValue = new PolarityValue();

      $firstCandidateId = $request->get('firstCandidateId');
      $secondCandidateId = $request->get('secondCandidateId');
      $firstYearCandidate = $request->get('firstCandidateYear');
      $secondYearCandidate = $request->get('secondCandidateYear');
      $firstCandidateMonth = $request->get('firstCandidateMonth');
      $secondCandidateMonth = $request->get('secondCandidateMonth');

      $getMonthsFirstCandidateDocuments = $emotionValue->getMonthsDocumentsCount($firstCandidateId, $firstYearCandidate, $firstCandidateMonth);
      $getMonthsSecondCandidateDocuments = $emotionValue->getMonthsDocumentsCount($secondCandidateId, $secondYearCandidate, $secondCandidateMonth);

      $getMonthsFirstCandidatePolarityDocuments = $polarityValue->getMonthsDocumentsCount($firstCandidateId, $firstYearCandidate, $firstCandidateMonth);
      $getMonthsSecondCandidatePolarityDocuments = $polarityValue->getMonthsDocumentsCount($secondCandidateId, $secondYearCandidate, $secondCandidateMonth);

      $totalFirstCandidateDocs = $emotionValue->totalDocumentMonths($firstCandidateId, $firstYearCandidate, $firstCandidateMonth);
      $totalSecondCandidateDocs = $emotionValue->totalDocumentMonths($secondCandidateId, $secondYearCandidate, $secondCandidateMonth);

      $totalFirstCandidatePolarityDocs = $polarityValue->totalDocumentMonths($firstCandidateId, $firstYearCandidate, $firstCandidateMonth);
      $totalSecondCandidatePolarityDocs = $polarityValue->totalDocumentMonths($secondCandidateId, $secondYearCandidate, $secondCandidateMonth);

      $firstCandidateEmotionsValues = $this->retrieveEmotionsValues($getMonthsFirstCandidateDocuments, $totalFirstCandidateDocs);
      $secondCandidateEmotionsValues = $this->retrieveEmotionsValues($getMonthsSecondCandidateDocuments, $totalSecondCandidateDocs);

      $firstCandidatePolarityValues = $this->retrievePolarityValues($getMonthsFirstCandidatePolarityDocuments, $totalFirstCandidatePolarityDocs);
      $secondCandidatePolarityValues = $this->retrievePolarityValues($getMonthsSecondCandidatePolarityDocuments, $totalSecondCandidatePolarityDocs);
      echo json_encode(array($firstCandidateEmotionsValues, $secondCandidateEmotionsValues, $firstCandidatePolarityValues, $secondCandidatePolarityValues));
    }

    public function daysWiseComparison(Request $request) {
      $emotionValue = new EmotionValue();
      $firstCandidateId = $request->get('firstCandidateId');
      $secondCandidateId = $request->get('secondCandidateId');
      $firstYearCandidate = $request->get('firstCandidateYear');
      $secondYearCandidate = $request->get('secondCandidateYear');
      $firstCandidateMonth = $request->get('firstCandidateMonth');
      $secondCandidateMonth = $request->get('secondCandidateMonth');
      $firstCandidateDay = $request->get('firstCandidateDay');
      $secondCandidateDay = $request->get('secondCandidateDay');

      $getDaysFirstCandidateDocuments = $emotionValue->getDaysDocumentsCount($firstCandidateId, $firstYearCandidate, $firstCandidateMonth, $firstCandidateDay);
      $getDaysSecondCandidateDocuments = $emotionValue->getDaysDocumentsCount($secondCandidateId, $secondYearCandidate, $secondCandidateMonth, $secondCandidateDay);

      $totalFirstCandidateDocs = $emotionValue->totalDocumentDays($firstCandidateId, $firstYearCandidate, $firstCandidateMonth, $firstCandidateDay);
      $totalSecondCandidateDocs = $emotionValue->totalDocumentDays($secondCandidateId, $secondYearCandidate, $secondCandidateMonth, $secondCandidateDay);

      $firstCandidateEmotionsValues = $this->retrieveEmotionsValues($getDaysFirstCandidateDocuments, $totalFirstCandidateDocs);
      $secondCandidateEmotionsValues = $this->retrieveEmotionsValues($getDaysSecondCandidateDocuments, $totalSecondCandidateDocs);
      echo json_encode(array($firstCandidateEmotionsValues, $secondCandidateEmotionsValues));
    }

    public function retrieveEmotionsValues($getCandidatesDocuments, $totalDocuments) {
      $emotionNames = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $emotionNamesFromDoc = array();
      $emotionValues = array();

      foreach($getCandidatesDocuments as $doc) {
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

    public function retrievePolarityValues($getCandidatesDocuments, $totalDocuments) {
      $polarityNames = array("Negative", "Offensive", "Positive");
      $polarityNamesFromDoc = array();
      $polarityValues = array();

      foreach($getCandidatesDocuments as $doc) {
          array_push($polarityNamesFromDoc, $doc->polarity);
          array_push($polarityValues, ($doc->count / $totalDocuments) * 100);
      }
      $diffArray = array_diff($polarityNames, $polarityNamesFromDoc);

      foreach($diffArray as $arr) {
        array_push($polarityNamesFromDoc, $arr);
      }

      foreach($diffArray as $key => $val) {
        array_splice($polarityValues, $key, 0, 0);
      }
      return $polarityValues;
    }

    public function getYears(Request $request) {
      $emotionValue = new EmotionValue();
      $firstCandidateId = $request->get('firstCandidateId');
      $secondCandidateId = $request->get('secondCandidateId');
      $firstCandidateYears = $emotionValue->retrieveYears($firstCandidateId);
      $secondCandidateYears = $emotionValue->retrieveYears($secondCandidateId);
      sort($firstCandidateYears);
      sort($secondCandidateYears);
      echo json_encode(array($firstCandidateYears, $secondCandidateYears));
    }

    public function getMonths(Request $request) {
      $emotionValue = new EmotionValue();
      $candidateId = $request->get('candidateId');
      $candidateYear = $request->get('candidateYear');
      $candidateMonths = $emotionValue->retrieveMonths($candidateId, $candidateYear);
      sort($candidateMonths);
      echo json_encode($candidateMonths);
    }

    public function getDays(Request $request) {
      $emotionValue = new EmotionValue();
      $candidateId = $request->get('candidateId');
      $candidateYear = $request->get('candidateYear');
      $candidateMonth = $request->get('candidateMonth');
      $candidateDays = $emotionValue->retrieveDays($candidateId, $candidateYear, $candidateMonth);
      echo json_encode($candidateDays);
    }
}
