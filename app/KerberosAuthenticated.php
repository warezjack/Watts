<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class KerberosAuthenticated extends Model
{
    protected $table = 'kerberos_authenticated';

    public function removeUserAuthentication($userId) {
      return DB::table('kerberos_authenticated')->where('user_id', '=', $userId)->delete();
    }

}
