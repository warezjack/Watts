<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job as Job;
use View;

class QueuesController extends Controller
{
    public function index() {
      $jobs = Job::all();
      return View::make('queues')->with(compact('jobs'));
    }
}
