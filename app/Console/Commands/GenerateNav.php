<?php

namespace App\Console\Commands;

use App\Services\GenerateNavigationService;
use Illuminate\Console\Command;

class GenerateNav extends Command
{
    protected $signature = 'navigation:generate';

    protected $description = 'Generate Navigation files';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            GenerateNavigationService::generate();
            $this->info('Navigation Generated successfully.');
        } catch (\Exception $e) {
            $this->error($e);
        }
    }
}
