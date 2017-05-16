<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\CandidateAssessment as CandidateAssessment;
use DateTime;

class CommenceCandidateAssessment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $CSVFile;
    protected $userId;
    protected $assessmentName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($CSVFile, $userId, $assessmentName)
    {
        $this->CSVFile = $CSVFile;
        $this->userId = $userId;
        $this->assessmentName = $assessmentName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $candidateAssessment = new CandidateAssessment;
      $candidateAssessment->user_id = $this->userId;
      $candidateAssessment->behaviour_id = $this->assessmentName;

      $now = new DateTime();
      $candidateAssessment->start_time = $now->format('Y-m-d H:i:s');

      $builder = new ProcessBuilder();
      $builder->setPrefix('/home/warez/spark/bin/spark-submit');
      $builder->setTimeout(36000000000);
      $builder->setArguments(array('/home/warez/spark/code/classifier/target/scala-2.11/classification-module_2.11-1.0.jar', $this->CSVFile, $this->userId))->getProcess()->getCommandLine();
      $builder->getProcess()->run();

      $candidateAssessment->end_time = $now->format('Y-m-d H:i:s');
      $candidateAssessment->is_completed = 1;
      $candidateAssessment->save();
    }
}
