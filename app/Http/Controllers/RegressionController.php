<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as Users;
use View;
use App\UsersDetail as UsersDetails;

class RegressionController extends Controller
{
  public function fetch() {
    $userObject = new Users();
    $usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();
    $users = $userObject->getUserCompletedAssessments($usersDetails['organisation_name']);
    return View::make('regression')->with(compact('users'));
  }
  public function predict(Request $request) {
    $candidateId = $request->get('candidateId');
  }
}
