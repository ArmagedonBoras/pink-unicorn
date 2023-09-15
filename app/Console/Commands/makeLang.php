<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class makeLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new skeleton for language file';

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
        $model = Str::ucfirst($this->argument('model'));
        $class = 'App\\Models\\'.$model;
        $instance = new $class;
        $filename = 'lang/sv/'.Str::lower($model).'.php';
        $content = [];
        if (file_exists($filename)) {
            $content = include($filename);
        }
        $table = Schema::getColumnListing($instance->getTable());

        $file = "<?php \n\nreturn [\n";

        foreach ($table as $field) {
            foreach (['label', 'placeholder', 'field', 'value', 'options'] as $type) {
                $key = $type."-".$field;
                $value = $content[$key] ?? "";
                unset($content[$key]);
                $file .= "    '".$key."' => '".$value."',\n";
            }
            $file .= "\n";
        }

        if (!isset($content['model'])) {
            $content['model'] = $model;
        }
        if (!isset($content['model_plural'])) {
            $content['model_plural'] = Str::plural($model);
        }

        foreach ($content as $key => $value) {
            $file .= "    '".$key."' => '".$value."',\n";
        }
        $file .= "];\n";
        file_put_contents($filename, $file);
        return 0;
    }
}
