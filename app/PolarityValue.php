<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PolarityValue extends Model
{
  public function allDocumentYears($userId) {
    return DB::table('polarity_values')
          ->select('year', 'user_id', 'polarity', DB::raw('count(polarity) as count'))
          ->groupBy('polarity', 'year', 'user_id')
          ->having('user_id', '=', $userId)
          ->get()
          ->toArray();
  }
  public function totalDocumentYears($userId, $year) {
    return DB::table('polarity_values')
          ->Where('user_id', '=', $userId)
          ->Where('year', '=', $year)
          ->count();
  }
  public function totalDocumentMonths($userId, $year, $month) {
    return DB::table('polarity_values')
          ->Where('user_id', '=', $userId)
          ->Where('year', '=', $year)
          ->Where('month', '=', $month)
          ->count();
  }
  public function allDocumentMonths($userId, $year) {
    return DB::table('polarity_values')
          ->select('year', 'month', 'user_id', 'polarity', DB::raw('count(polarity) as count'))
          ->groupBy('polarity', 'year', 'user_id', 'month')
          ->having('user_id', '=', $userId)
          ->having('year', '=', $year)
          ->orderBy('month', 'asc')
          ->get()
          ->toArray();
  }
  public function allDocumentDays($userId, $year, $month) {
    return DB::table('polarity_values')
          ->select('year', 'month', 'day', 'user_id', 'polarity', DB::raw('count(polarity) as count'))
          ->groupBy('polarity', 'year', 'user_id', 'month', 'day')
          ->having('user_id', '=', $userId)
          ->having('year', '=', $year)
          ->having('month', '=', $month)
          ->get()
          ->toArray();
  }
  public function totalDocumentDays($userId, $year, $month, $day) {
    return DB::table('polarity_values')
          ->Where('user_id', '=', $userId)
          ->Where('year', '=', $year)
          ->Where('month', '=', $month)
          ->Where('day', '=', $day)
          ->count();
  }
}
