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
            ->Where('year', '=', $year)
            ->get();
    }

    public function totalDocumentYears($userId, $year) {
      return DB::table('emotions_values')
            ->Where('user_id', '=', $userId)
            ->Where('year', '=', $year)
            ->count();
    }

    public function specificDocumentYears($userId, $year) {
      return DB::table('emotions_values')
            ->select('year', 'user_id', 'emotion', DB::raw('count(emotion) as count'))
            ->groupBy('emotion', 'year', 'user_id')
            ->having('user_id', '=', $userId)
            ->having('year', '=',  $year)
            ->get()
            ->toArray();
    }

    public function retrieveEmotionValues($userId, $year, $month) {

    }
}
