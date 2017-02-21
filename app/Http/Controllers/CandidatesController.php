<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User as Users;
use App\UsersDetail as UsersDetails;

class CandidatesController extends Controller
{

	public function __construct() {
		$this->middleware('auth', ['except' => 'logout']);
	}

    public function index() {
    	
    	$usersDetails = UsersDetails::where('user_id', Auth::user()->id)->first();

    	$users = DB::table('users')
            ->join('users_details', 'users.id', '=', 'users_details.user_id')
            ->select('users_details.organisation_name', 'users.email', 'users.is_admin')
            ->where('users.is_admin', 0)
            ->where('organisation_name', $usersDetails['organisation_name'])
            ->get();

        return view('candidates', compact('$users'));
    }
}
