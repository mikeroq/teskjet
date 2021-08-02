<?php

namespace App\Console\Commands;

use App\Services\GenerateNavigationService;
use Illuminate\Console\Command;

class GenerateNav extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'navigation:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Navigation files';

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
     * @return int
     */
    public function handle()
    {
        try {
            GenerateNavigationService::generate();
            echo "Navigation Generated.";
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
