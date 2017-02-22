<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUserDetails($organisation_name) {
        $users = DB::table('users')
            ->join('users_details', 'users.id', '=', 'users_details.user_id')
            ->select(
                'users.id',
                'users.is_admin',
                'users_details.full_name',
                'users_details.gender',
                'users.email',
                'users_details.state',
                'users_details.city',
                'users_details.organisation_name',  
                'users_details.date_of_joining'
            )
            ->where('users.is_admin', 0)
            ->orwhere('users.is_admin', 2)
            ->where('organisation_name', $organisation_name)
            ->get();
        return $users;
    }

    public function fetchTwitterUrl($userId) {
        $twitterUrl = DB::table('users')
            ->join('users_details', 'users.id', '=', 'users_details.user_id')
            ->select('users_details.connect_to_twitter')
            ->where('users_details.user_id', $userId)
            ->get();
        return $twitterUrl;
    }
}
