<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PredictedValue extends Model
{
    protected $table = 'predicted_values';

    public function getPredictedValues($userId) {
      return DB::table('predicted_values')
            ->select('emotion', 'year', 'predicted_value')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();
    }

    public function distinctYears($userId) {
      return DB::table('predicted_values')
            ->select('year')
            ->distinct()
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();
    }
}
