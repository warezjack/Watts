<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Auth;
use App\User as Users;
use App\EmotionValue as EmotionValue;
use App\PolarityValue as PolarityValue;
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
      sort($years);
      echo json_encode($years);
    }

    public function months(Request $request) {
      $emotionValue = new EmotionValue;
      $year = $request->get('year');
      $candidateId = $request->get('candidateId');
      $months = $emotionValue->retrieveMonths($candidateId, $year);
      sort($months);
      echo json_encode($months);
    }

    public function yearsWiseData(Request $request) {
      $emotionValue = new EmotionValue;
      $polarityValue = new polarityValue;

      $candidateId = $request->get('candidateId');
      $allYearsDocs = $emotionValue->allDocumentYears($candidateId);
      $allYearPolarityDocs = $polarityValue->allDocumentYears($candidateId);

      $emotions_names = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $polarity_names = array("Negative", "Offensive", "Positive");

      $unique_year = $this->getUniqueElements($allYearsDocs, 1);

      foreach($unique_year as $year) {
        $emotions[$year] = array();
        $polarity[$year] = array();
        $emotions_values[$year] = array();
        $polarity_values[$year] = array();

        $total = $emotionValue->totalDocumentYears($candidateId, $year);
        $totalPolarityValue = $polarityValue->totalDocumentYears($candidateId, $year);

        foreach($allYearsDocs as $doc) {
          if($year == $doc->year) {
            $categoryPerc = ($doc->count / $total) * 100;
            array_push($emotions[$year], $categoryPerc);
            array_push($emotions_values[$year], $doc->emotion);
          }
        }

        foreach($allYearPolarityDocs as $doc) {
          if($year == $doc->year) {
            $categoryPercent = ($doc->count / $totalPolarityValue) * 100;
            array_push($polarity[$year], $categoryPercent);
            array_push($polarity_values[$year], $doc->polarity);
          }
        }
      }

      foreach ($unique_year as $year) {
        $diffArray = array_diff($emotions_names, $emotions_values[$year]);
        $diffPolarityArray = array_diff($polarity_names, $polarity_values[$year]);
        foreach ($diffArray as $arr) {
          array_push($emotions_values[$year], $arr);
        }
        foreach ($diffPolarityArray as $arr) {
          array_push($polarity_values[$year], $arr);
        }

        sort($emotions_values[$year]);
        sort($polarity_values[$year]);

        foreach($diffArray as $key => $val) {
          array_splice($emotions[$year], $key, 0, 0);
        }
        foreach($diffPolarityArray as $key => $val) {
          array_splice($polarity[$year], $key, 0, 0);
        }
      }
      echo json_encode(array($unique_year, $emotions, $emotions_values, $polarity, $polarity_values));
    }

    public function monthsWiseData(Request $request) {
      $emotionValue = new EmotionValue;
      $polarityValue = new polarityValue;

      $candidateId = $request->get('candidateId');
      $year = $request->get('year');

      $allDocs = $emotionValue->allDocumentMonths($candidateId, $year);
      $allPolarityDocs = $polarityValue->allDocumentMonths($candidateId, $year);

      $emotions_names = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $polarity_names = array("Negative", "Offensive", "Positive");

      $unique_months = $this->getUniqueElements($allDocs, 0);

      foreach($unique_months as $month) {
        $emotions[$month] = array();
        $emotions_values[$month] = array();
        $polarity[$month] = array();
        $polarity_values[$month] = array();

        $total = $emotionValue->totalDocumentMonths($candidateId, $year, $month);
        $totalPolarity = $polarityValue->totalDocumentMonths($candidateId, $year, $month);

        foreach($allDocs as $doc) {
          if($month == $doc->month) {
            $categoryPerc = ($doc->count / $total) * 100;
            array_push($emotions_values[$month], $categoryPerc);
            array_push($emotions[$month], $doc->emotion);
          }
        }
        foreach($allPolarityDocs as $doc) {
          if($month == $doc->month) {
            $categoryPercent = ($doc->count / $totalPolarity) * 100;
            array_push($polarity_values[$month], $categoryPercent);
            array_push($polarity[$month], $doc->polarity);
          }
        }
      }
      foreach ($unique_months as $month) {
        $diffArray = array_diff($emotions_names, $emotions[$month]);
        $diffPolarityArray = array_diff($polarity_names, $polarity[$month]);

        foreach ($diffArray as $arr) {
          array_push($emotions[$month], $arr);
        }
        foreach ($diffPolarityArray as $arr) {
          array_push($polarity[$month], $arr);
        }

        sort($emotions[$month]);
        sort($polarity[$month]);

        foreach($diffArray as $key => $val) {
          array_splice($emotions_values[$month], $key, 0, 0);
        }
        foreach($diffPolarityArray as $key => $val) {
          array_splice($polarity_values[$month], $key, 0, 0);
        }
      }
      echo json_encode(array($unique_months, $emotions, $emotions_values, $polarity, $polarity_values));
    }

    public function daysWiseData(Request $request) {
      $emotionValue = new EmotionValue;
      $polarityValue = new polarityValue;

      $candidateId = $request->get('candidateId');
      $year = $request->get('year');
      $month = $request->get('month');

      $allDocs = $emotionValue->allDocumentDays($candidateId, $year, $month);
      $allPolarityDocs = $polarityValue->allDocumentDays($candidateId, $year, $month);

      $emotions_names = array("Anger", "Disgust", "Fear", "Joy", "Love", "Sadness", "Surprise");
      $polarity_names = array("Negative", "Offensive", "Positive");

      $elements = array();
      foreach ($allDocs as $doc) {
        array_push($elements, $doc->day);
      }
      $unique_days = array_unique($elements);

      foreach($unique_days as $day) {
        $emotions[$day] = array();
        $emotions_values[$day] = array();
        $polarity[$day] = array();
        $polarity_values[$day] = array();

        $total = $emotionValue->totalDocumentDays($candidateId, $year, $month, $day);
        $totalPolarity = $polarityValue->totalDocumentDays($candidateId, $year, $month, $day);

        foreach($allDocs as $doc) {
          if($day == $doc->day) {
            $categoryPerc = ($doc->count / $total) * 100;
            array_push($emotions_values[$day], $categoryPerc);
            array_push($emotions[$day], $doc->emotion);
          }
        }
        foreach($allPolarityDocs as $doc) {
          if($day == $doc->day) {
            $categoryPercent = ($doc->count / $totalPolarity) * 100;
            array_push($polarity_values[$day], $categoryPercent);
            array_push($polarity[$day], $doc->polarity);
          }
        }
      }
      foreach ($unique_days as $day) {
        $diffArray = array_diff($emotions_names, $emotions[$day]);
        $diffPolarityArray = array_diff($polarity_names, $polarity[$day]);

        foreach ($diffArray as $arr) {
          array_push($emotions[$day], $arr);
        }
        foreach ($diffPolarityArray as $arr) {
          array_push($polarity[$day], $arr);
        }

        sort($polarity[$day]);
        sort($emotions[$day]);

        foreach($diffArray as $key => $val) {
          array_splice($emotions_values[$day], $key, 0, 0);
        }
        foreach($diffPolarityArray as $key => $val) {
          array_splice($polarity_values[$day], $key, 0, 0);
        }
      }
      echo json_encode(array($unique_days, $emotions, $emotions_values, $polarity, $polarity_values));
    }

    public function getUniqueElements($arr, $status) {
      $elements = array();
      foreach ($arr as $doc) {
        array_push($elements, $status ? $doc->year : $doc->month);
      }
      return array_unique($elements);
    }
}
