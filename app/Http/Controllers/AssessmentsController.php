<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $candidateAssessment = new CandidateAssessment;
        $candidateAssessment->user_id = $userId;
        $candidateAssessment->behaviour_id = $assessmentName;

        $now = new DateTime();
        $candidateAssessment->start_time = $now->format('Y-m-d H:i:s');

        $csv_file = $getCandidateCSV->csv_location;
        $builder = new ProcessBuilder();
  			$builder->setPrefix('/home/warez/spark/bin/spark-submit');
  			$builder->setTimeout(3600000);
  			$builder->setArguments(array('/home/warez/spark/code/classifier/target/scala-2.11/classification-module_2.11-1.0.jar', $csv_file, $userId))->getProcess()->getCommandLine();
  		  $builder->getProcess()->run();

        $candidateAssessment->end_time = $now->format('Y-m-d H:i:s');
        $candidateAssessment->is_completed = 1;
        $candidateAssessment->save();

        notify()->flash("Candidate's data has been successfully analyzed", 'success');
  			return redirect()->to('assessments');
      }
      else {
        notify()->flash("Candidate's data needs to be downloaded first!", 'error');
  			return redirect()->to('assessments');
      }
    }
}
