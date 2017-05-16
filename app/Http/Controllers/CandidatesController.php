<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\DownloadCandidateTweets;
use App\User as Users;
use App\Behaviour as Behaviours;
use View;
use App\UsersDetail as UsersDetails;
use App\CandidateAssessment as CandidateAssessment;
use App\TwitterStatus as TwitterStatus;

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

			//dispatch queue
			$this->dispatch(new DownloadCandidateTweets($screenName, $id));

			notify()->flash("Candidate's tweets are put on download queue", 'success');
			return redirect()->to('candidates');
    }

    public function fetch() {
      $userObject = new Users();
			$candidateObject = new CandidateAssessment();

      $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
      $users = $userObject->getUserDownloadedData($usersDetails['organisation_name']);
      $behaviours = Behaviours::all('id', 'assessment_name');
			$assessments = $candidateObject->getCandidateData();
			return View::make('assessments')->with(compact('users', 'behaviours', 'assessments'));
    }
}
