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
use App\TwitterStatus as TwitterStatus;

class CopyToAlluxio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $screenName;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($screenName, $id)
     {
       $this->screenName = $screenName;
       $this->id = $id;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $twitterStatus = new TwitterStatus;
			$twitterStatus->user_id = $this->id;
			$twitterStatus->is_downloaded = 1;
      $csvLocation = '/home/warez/dataset/twitter/files/' . $this->screenName . '_tweets.csv';

      $alluxio = new ProcessBuilder();
      $alluxio->setPrefix('alluxio fs copyFromLocal');
      $alluxio->setTimeout(36000);
      $alluxio->disableOutput();
      $alluxio->setArguments(array($csvLocation, '/tweets'))->getProcess()->getCommandLine();
      $alluxio->getProcess()->run();

      $twitterStatus->csv_location = '/tweets' . '/' . $this->screenName . '_tweets.csv';
      $twitterStatus->save();
    }
}
