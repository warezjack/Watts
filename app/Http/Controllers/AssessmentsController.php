<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CommenceCandidateAssessment;
use App\UsersDetail as UsersDetails;
use App\TwitterStatus as TwitterStatus;
use App\CandidateAssessment as CandidateAssessment;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use DateTime;

class AssessmentsController extends Controller
{
    public function executeSparkCode(Request $request) {
      $userId = $request->get('candidate_user_id');
      $assessmentName = $request->get('behaviour_name');

      $getCandidateCSV = TwitterStatus::where('user_id', $userId)->first();
      if(isset($getCandidateCSV)) {

        //dispatch queue
        $this->dispatch(new CommenceCandidateAssessment($getCandidateCSV->csv_location, $userId, $assessmentName));

        notify()->flash("Candidate's data has been successfully analyzed", 'success');
  			return redirect()->to('assessments');
      }
      else {
        notify()->flash("Candidate's data needs to be downloaded first!", 'error');
  			return redirect()->to('assessments');
      }
    }
}
