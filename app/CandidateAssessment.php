<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UsersDetail as UsersDetails;
use App\Behaviour as Behaviours;
use DB;

class CandidateAssessment extends Model
{
    public function getCandidateData($organisation_name) {
      return $data = DB::table('candidate_assessments')
        ->join('users_details', 'candidate_assessments.user_id', '=', 'users_details.user_id')
        ->leftJoin('behaviours', 'candidate_assessments.behaviour_id', '=', 'behaviours.id')
        ->leftJoin('users', 'candidate_assessments.user_id', '=', 'users.id')
        ->select(
          'users_details.full_name',
          'behaviours.assessment_name',
          'users.is_admin',
          'users.email',
          'candidate_assessments.start_time',
          'candidate_assessments.end_time',
          'candidate_assessments.is_completed'
        )->where('users_details.organisation_name', $organisation_name)->get();
    }

    public function removeCandidateRecord($userId) {
      return DB::table('candidate_assessments')->where('user_id', '=', $userId)->delete();
    }
}
