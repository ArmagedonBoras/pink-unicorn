<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class Reseed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reseeds and clears caches';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('cache:clear');
        $this->call('permission:cache-reset');
        $this->call('optimize:clear');
        $this->call('config:clear');
        $this->call('storage:link', ['--relative' => true, '--force' => true]);
        if (App::environment() != 'production') {
            $this->call('migrate:fresh', ['--seed' => true]);
        }
    }
}
