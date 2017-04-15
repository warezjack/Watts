<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as Users;
use App\Behaviour as Behaviours;
use View;
use App\UsersDetail as UsersDetails;
use App\CandidateAssessment as CandidateAssessment;
use App\TwitterStatus as TwitterStatus;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CandidatesController extends Controller
{

	public function __construct() {
		$this->middleware('auth', ['except' => 'logout']);
	}

    public function index() {
    	$userObject = new Users();
    	$usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
    	$users = $userObject->getUserDetails($usersDetails['organisation_name']);
			return View::make('candidates')->with(compact('users'));
    }

    public function show($id) {
    	$userObject = new Users();
    	$twitterUrl = $userObject->fetchTwitterUrl($id);
			list($proto, $second) = explode('[{"connect_to_twitter":"http:\/\/www.twitter.com\/', $twitterUrl);
			list($screenName) = explode('"}]', $second);

			$builder = new ProcessBuilder();
			$builder->setPrefix('python');
			$builder->setTimeout(3600);
			$builder->disableOutput();
			$builder->setArguments(array('/home/warez/dataset/twitter/tweet_dumper.py', $screenName))->getProcess()->getCommandLine();
			$builder->getProcess()->run();

			$twitterStatus = new TwitterStatus;
			$twitterStatus->user_id = $id;
			$twitterStatus->is_downloaded = 1;
			$twitterStatus->csv_location = '/home/warez/dataset/twitter/files/' . $screenName . '_tweets.csv';
			$twitterStatus->save();

			notify()->flash("Candidate's data has been successfully downloaded", 'success');
			return redirect()->to('candidates');
    }

    public function fetch() {
      $userObject = new Users();
			$candidateObject = new CandidateAssessment();

      $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
      $users = $userObject->getUserDetails($usersDetails['organisation_name']);
      $behaviours = Behaviours::all('id', 'assessment_name');
			$assessments = $candidateObject->getCandidateData();
			return View::make('assessments')->with(compact('users', 'behaviours', 'assessments'));
    }
}
