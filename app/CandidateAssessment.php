<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UsersDetail as UsersDetails;
use App\Behaviour as Behaviours;
use DB;

class CandidateAssessment extends Model
{
    public function getCandidateData() {
      return $data = DB::table('candidate_assessments')
        ->join('users_details', 'candidate_assessments.user_id', '=', 'users_details.user_id')
        ->leftJoin('behaviours', 'candidate_assessments.behaviour_id', '=', 'behaviours.id')
        ->leftJoin('users', 'candidate_assessments.user_id', '=', 'users.id')
        ->select(
          'users_details.full_name',
          'behaviours.assessment_name',
          'users.is_admin',
          'candidate_assessments.start_time',
          'candidate_assessments.end_time',
          'candidate_assessments.is_completed'
        )->get();
    }
}
