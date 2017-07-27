<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Users;
use App\UsersDetail as UsersDetails;
use App\EmotionValue as EmotionValue;
use View;
use Auth;

class PlutchikController extends Controller
{
    public function index() {
      $userObject = new Users();
      $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
      $users = $userObject->getUserCompletedAssessments($usersDetails['organisation_name']);
      return View::make('plutchik')->with(compact('users'));
    }

    public function years(Request $request) {
      $emotionValue = new EmotionValue;
      $candidateId = $request->get('candidateId');
      $years = $emotionValue->retrieveYears($candidateId);
      sort($years);
      echo json_encode($years);
    }

    public function dyads(Request $request) {
      $candidateId = $request->get('candidateId');
      $year = $request->get('year');
      $emotionValue = new EmotionValue();
      $getYearsCandidateDocuments = $emotionValue->getYearsDocumentsCount($candidateId, $year);
      $totalCandidateDocs = $emotionValue->totalDocumentYears($candidateId, $year);
      $candidateEmotionsValues = $this->retrieveEmotionsValues($getYearsCandidateDocuments, $totalCandidateDocs);
      $primaryDyads = $this->computePrimaryDyads($candidateEmotionsValues[0]);
      $secondaryDyads = $this->computeSecondaryDyads($candidateEmotionsValues[0]);
      $tertiaryDyads = $this->computeTertiaryDyads($candidateEmotionsValues[0]);
      echo json_encode(array($candidateEmotionsValues[0], $primaryDyads, $secondaryDyads, $tertiaryDyads, $candidateEmotionsValues[1]));
    }

    public function computePrimaryDyads($candidateEmotionsValues) {
      $primaryDyads = array();
      $submission = $this->checkCombination($candidateEmotionsValues[6], $candidateEmotionsValues[2]);
      $alarm = $this->checkCombination($candidateEmotionsValues[2], $candidateEmotionsValues[5]);
      $disappointment = $this->checkCombination($candidateEmotionsValues[5], $candidateEmotionsValues[4]);
      $remorse = $this->checkCombination($candidateEmotionsValues[1], $candidateEmotionsValues[4]);
      $contempt = $this->checkCombination($candidateEmotionsValues[1], $candidateEmotionsValues[0]);
      $aggression = $this->checkCombination($candidateEmotionsValues[0], $candidateEmotionsValues[7]);
      $optimism = $this->checkCombination($candidateEmotionsValues[7], $candidateEmotionsValues[3]);
      array_push($primaryDyads, $submission, $alarm, $disappointment, $remorse, $contempt, $aggression, $optimism);
      return $primaryDyads;
    }

    public function computeSecondaryDyads($candidateEmotionsValues) {
      $secondaryDyads = array();
      $guilt = $this->checkCombination($candidateEmotionsValues[3], $candidateEmotionsValues[2]);
      $curiosity = $this->checkCombination($candidateEmotionsValues[5], $candidateEmotionsValues[6]);
      $despair = $this->checkCombination($candidateEmotionsValues[2], $candidateEmotionsValues[4]);
      $envy = $this->checkCombination($candidateEmotionsValues[4], $candidateEmotionsValues[0]);
      $cynisim = $this->checkCombination($candidateEmotionsValues[1], $candidateEmotionsValues[7]);
      $pride = $this->checkCombination($candidateEmotionsValues[0], $candidateEmotionsValues[3]);
      $fatalism = $this->checkCombination($candidateEmotionsValues[7], $candidateEmotionsValues[6]);
      array_push($secondaryDyads, $guilt, $curiosity, $despair, $envy, $cynisim, $pride, $fatalism);
      return $secondaryDyads;
    }

    public function computeTertiaryDyads($candidateEmotionsValues) {
      $tertiaryDyads = array();
      $delight = $this->checkCombination($candidateEmotionsValues[3], $candidateEmotionsValues[5]);
      $sentimentality = $this->checkCombination($candidateEmotionsValues[4], $candidateEmotionsValues[6]);
      $shame = $this->checkCombination($candidateEmotionsValues[2], $candidateEmotionsValues[1]);
      $outrage = $this->checkCombination($candidateEmotionsValues[0], $candidateEmotionsValues[5]);
      $pessimism = $this->checkCombination($candidateEmotionsValues[7], $candidateEmotionsValues[4]);
      $morbidness = $this->checkCombination($candidateEmotionsValues[1], $candidateEmotionsValues[3]);
      $dominance = $this->checkCombination($candidateEmotionsValues[0], $candidateEmotionsValues[6]);
      $anxiety = $this->checkCombination($candidateEmotionsValues[7], $candidateEmotionsValues[2]);
      array_push($tertiaryDyads, $delight, $sentimentality, $shame, $outrage, $pessimism, $morbidness, $dominance, $anxiety);
      return $tertiaryDyads;
    }

    public function checkCombination($firstPrimaryEmotion, $secondPrimaryEmotion) {
      $combination = 0;
      if($firstPrimaryEmotion == 1 && $secondPrimaryEmotion == 1) {
        $combination = 1;
      }
      return $combination;
    }

    public function retrieveEmotionsValues($getCandidatesDocuments, $totalDocuments) {
      $emotionNames = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $emotionNamesFromDoc = array();
      $categoryPercent = array();
      $emotionValues = array();

      foreach($getCandidatesDocuments as $doc) {
          array_push($emotionNamesFromDoc, $doc->emotion);
          $emotionPercent = ($doc->count / $totalDocuments) * 100;
          $emotionLevel = 1;
          if($emotionPercent <= 10) {
            $emotionLevel = 0;
          }
          array_push($categoryPercent, $emotionPercent);
          array_push($emotionValues, $emotionLevel);
      }
      $diffArray = array_diff($emotionNames, $emotionNamesFromDoc);

      foreach($diffArray as $arr) {
        array_push($emotionNamesFromDoc, $arr);
      }

      foreach($diffArray as $key => $val) {
        array_splice($emotionValues, $key, 0, 0);
        array_splice($categoryPercent, $key, 0, 0);
      }
      array_splice($emotionValues, 4, 1);
      array_splice($categoryPercent, 4 , 1);
      $trustValue = 1;
      if ($emotionNames[1] == 1) {
        $trustValue = 0;
      }
      $anticipationValue = 1;
      if($emotionNames[6] == 1) {
        $anticipationValue = 0;
      }
      array_push($emotionValues, $trustValue);
      array_push($emotionValues, $anticipationValue);
      return array($emotionValues, $categoryPercent);
    }

}
