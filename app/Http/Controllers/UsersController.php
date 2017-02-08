<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\User as Users;
use Alert;

class UsersController extends Controller
{
    public function signup(Request $request) {
        if($request->get('type_of_user')) {
            $admins = new Users();
            $admins->email = $request->get('email');
            $admins->password = bcrypt($request->get('password'));
            $admins->is_admin = $request->get('type_of_user');
            $admins->save();
        }
        echo 'Twitter Account' . $request->get('type_of_user');
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
        if (Auth::attempt(['email' => $email, 'password' => $password]) && Auth::user()->is_admin) {
            notify()->flash('You are signed in', 'success');
            return redirect()->intended('index');
        }
        notify()->flash('Please check your credentials. Try again.', 'error');
        return redirect()->to('login');
    }
}
