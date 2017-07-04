<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class PredictedPvalue extends Model
{
    protected $table = 'predicted_pvalues';

    public function getPredictedPValues($userId) {
      return DB::table('predicted_pvalues')
            ->select('polarity', 'year', 'predicted_value')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();
    }
}
