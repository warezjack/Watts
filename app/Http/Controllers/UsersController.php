<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\User as Users;
use App\UsersDetail as UsersDetails;
use Alert;

class UsersController extends Controller
{
    public function signup(Request $request) {
        //Admin
        $adminsId = $this->storeAuthenticationDetails($request);
        //store details
        $this->storeUserDetails($request, $adminsId);

        // redirect
        notify()->flash('User Successfully Registered', 'success');
        return redirect()->to('login');
    }

    public function logout() {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function login(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password]) && Auth::user()->is_admin == 1) {
            notify()->flash('You are signed in', 'success');
            return redirect()->intended('index');
        }
        notify()->flash('Please check your credentials. Try again.', 'error');
        return redirect()->to('login');
    }

    public function storeUserDetails($request, $adminsId) {
        $userDetails = new UsersDetails;
        $userDetails->full_name = $request->get('full_name');
        $userDetails->gender = $request->get('gender');
        $userDetails->address =  $request->get('address');
        $userDetails->state = $request->get('state_name');
        $userDetails->city = $request->get('city_name');
        $userDetails->connect_to_fb = $request->get('connect_to_fb');
        $userDetails->connect_to_twitter = $request->get('connect_to_twitter');
        $userDetails->organisation_name = $request->get('org_name');
        $converted_date = date("Y-m-d", strtotime($request->get('date_of_joining')));
        $userDetails->date_of_joining = $converted_date;
        $userDetails->user_id = $adminsId;
        $userDetails->save();
    }

    public function storeAuthenticationDetails($request) {
        $admins = new Users();
        $admins->email = $request->get('email');
        $admins->password = bcrypt($request->get('password'));
        $admins->is_admin = $request->get('type_of_user');
        $admins->save();
        return $admins->id;
    }
}
