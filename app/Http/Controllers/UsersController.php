<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\User as Users;

class UsersController extends Controller
{
    public function signup(Request $request) {
        $admins = new Users();
        $admins->email = $request->get('email');
        $admins->password = bcrypt($request->get('password'));
        $admins->save();

        echo $admins;
    	echo 'Twitter Account' . $request->get('connect_to_twitter');
    	echo 'Full Name'. $request->get('full_name');
    	echo 'Gender - Male' . $request->get('male');
    	echo 'Gender - Female' . $request->get('female');
    	echo 'Address' . $request->get('address');
    	echo 'Email' . $request->get('email');
    	echo 'Password' . $request->get('password');
    	echo 'Facebook' . $request->get('connect_to_fb');
    	echo 'Date Of Joining' . $request->get('date_of_joining');
    	echo 'Organisation Name' . $request->get('org_name');
    	echo 'State Name' . $request->get('state_name');
    	echo 'City Name' . $request->get('city_name');
    }

    public function logout() {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function login(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('index');
        }
        return view('login');
    }
}
