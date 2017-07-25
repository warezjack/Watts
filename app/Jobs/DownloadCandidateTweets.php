<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Process;
use Illuminate\Queue\Events\JobProcessed;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\TwitterStatus as TwitterStatus;

class DownloadCandidateTweets implements ShouldQueue
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
      $builder = new ProcessBuilder();
			$builder->setPrefix('python');
			$builder->setTimeout(36000);
			$builder->disableOutput();
			$builder->setArguments(array('/home/warez/dataset/twitter/tweet_dumper.py', $this->screenName))->getProcess()->getCommandLine();
			$builder->getProcess()->run();
    }
}
