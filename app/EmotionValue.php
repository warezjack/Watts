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
            ->get()
            ->toArray();
    }

    public function retrieveMonths($userId, $year) {
      return DB::table('emotions_values')
            ->select('month')
            ->distinct()
            ->Where('user_id', '=', $userId)
            ->Where('year', '=', $year)
            ->get()
            ->toArray();
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

    public function allDocumentYears($userId) {
      return DB::table('emotions_values')
            ->select('year', 'user_id', 'emotion', DB::raw('count(emotion) as count'))
            ->groupBy('emotion', 'year', 'user_id')
            ->having('user_id', '=', $userId)
            ->get()
            ->toArray();
    }

    public function totalDocumentMonths($userId, $year, $month) {
      return DB::table('emotions_values')
            ->Where('user_id', '=', $userId)
            ->Where('year', '=', $year)
            ->Where('month', '=', $month)
            ->count();
    }

    public function allDocumentMonths($userId, $year) {
      return DB::table('emotions_values')
            ->select('year', 'month', 'user_id', 'emotion', DB::raw('count(emotion) as count'))
            ->groupBy('emotion', 'year', 'user_id', 'month')
            ->having('user_id', '=', $userId)
            ->having('year', '=', $year)
            ->orderBy('month', 'asc')
            ->get()
            ->toArray();
    }

    public function allDocumentDays($userId, $year, $month) {
      return DB::table('emotions_values')
            ->select('year', 'month', 'day', 'user_id', 'emotion', DB::raw('count(emotion) as count'))
            ->groupBy('emotion', 'year', 'user_id', 'month', 'day')
            ->having('user_id', '=', $userId)
            ->having('year', '=', $year)
            ->having('month', '=', $month)
            ->get()
            ->toArray();
    }

    public function totalDocumentDays($userId, $year, $month, $day) {
      return DB::table('emotions_values')
            ->Where('user_id', '=', $userId)
            ->Where('year', '=', $year)
            ->Where('month', '=', $month)
            ->Where('day', '=', $day)
            ->count();
    }

    public function getPastYear($userId) {
      return DB::table('emotions_values')
            ->select('year')
            ->distinct()
            ->Where('user_id', '=', $userId)
            ->limit(1)
            ->get()
            ->toArray();
    }

    public function getPastYearDocumentCount($userId, $year) {
      return DB::table('emotions_values')
            ->select('emotion', 'year', 'user_id', DB::raw('count(emotion) as count'))
            ->groupBy('emotion', 'year', 'user_id')
            ->having('user_id', '=', $userId)
            ->having('year', '=', $year)
            ->get();
    }
}
