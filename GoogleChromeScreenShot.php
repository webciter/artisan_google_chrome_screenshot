<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GoogleChromeScreenShot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_chrome:screen_shot {--input_url=} {--output_filename=} {--width=1920} {--height=1080}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes a screenshot of a website.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $storagePath  = \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $command = "google-chrome --headless --disable-gpu --screenshot='{$storagePath}".$this->option("output_filename")."' --window-size=".$this->option("width").",".$this->option("height")." ".$this->option("input_url");
            $this->info($command);
            exec($command);
        } catch (Exception $ex) {
            $this->info($ex->getMessage());
        }
        
    }
}
