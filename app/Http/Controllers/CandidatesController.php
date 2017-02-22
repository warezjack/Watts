<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as Users;
use App\Behaviour as Behaviours;
use View;
use App\UsersDetail as UsersDetails;
use Symfony\Component\Process\Process;
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
        print_r($twitterUrl);	
    }

    public function fetch() {
        $userObject = new Users();
        $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
        $users = $userObject->getUserDetails($usersDetails['organisation_name']);

        $behaviours = Behaviours::all('id', 'assessment_name');
        return View::make('assessments')->with(compact('users', 'behaviours'));
    }
}
