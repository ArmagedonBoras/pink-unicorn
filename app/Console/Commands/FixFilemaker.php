<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixFilemaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixfilemaker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes vendor package for FileMaker with problematic https';



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'vendor/gearbox-solutions/eloquent-filemaker/src/Services/FileMakerConnection.php';
        $file = file_get_contents($filename);

        $file = Str::replace("Http::withBasicAuth", "Http::withOptions(['verify' => false])->withBasicAuth", $file);
        $file = Str::replace("Http::attach", "Http::withOptions(['verify' => false])->attach", $file);
        $file = Str::replace("Http::withBody", "Http::withOptions(['verify' => false])->withBody", $file);
        $file = Str::replace("Http::withToken", "Http::withOptions(['verify' => false])->withToken", $file);

        file_put_contents($filename, $file);
        return 0;
    }
}
