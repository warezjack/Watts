<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmotionValue extends Model
{

    public function retrieveYears($userId) {
      return DB::table('emotions_values')
            ->select('year')
            ->distinct()
            ->where('user_id', '=', $userId)
            ->get();
    }

    public function retrieveMonths($userId, $year) {
      return DB::table('emotions_values')
            ->select('month')
            ->distinct()
            ->Where('user_id', '=', $userId)
            ->where('year', '=', $year)
            ->get();
    }

    public function retrieveEmotionValues($userId, $year, $month) {

    }
}
