<?php

namespace App\Console\Commands;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use ReflectionMethod;

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

    protected function hasRelationships($model): array
    {
        $relationshipMethods = [];
        $reflectionClass = new ReflectionClass($model);
        $reflectionMethods = $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);
        $relationshipHelpers = [
            'belongsto', 'hasone', 'hasmany', 'belongstomany',
            'hasmanythrough', 'morphone', 'morphone', 'morphmany',
            'morphto', 'morphtomany', 'through', 'embedsone',
            'embedsmany', 'embedsmany', 'embedsmany'
        ];

        foreach ($reflectionMethods as $reflectionMethod) {
            $methodName = $reflectionMethod->getName();
            $methodReturnType = $reflectionMethod->getReturnType();
            if ($methodReturnType !== null) {
                $methodReturnTypeString = $methodReturnType->getName();
                $shortname = explode("\\", $methodReturnTypeString);
                $relationshipClass = strtolower(end($shortname));


                if(in_array($relationshipClass, $relationshipHelpers)) {
                    $relationshipMethods[] = $methodName;
                }
            }
        }

        return $relationshipMethods;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = Str::ucfirst($this->argument('model'));
        $class = 'App\\Models\\' . $model;
        $instance = new $class();
        $filename = 'lang/sv/' . Str::lower($model) . '.php';
        $content = [];
        if (file_exists($filename)) {
            $content = include($filename);
        }
        $table = Schema::getColumnListing($instance->getTable());

        $file = "<?php \n\nreturn [\n";

        foreach ($table as $field) {
            foreach (['label', 'placeholder', 'field', 'value', 'options'] as $type) {
                $key = $type . "-" . $field;
                $value = $content[$key] ?? "";
                unset($content[$key]);
                $file .= "    '" . $key . "' => '" . $value . "',\n";
            }
            $file .= "\n";
        }
        foreach ($this->hasRelationships($instance) as $relationship) {
            if (\in_array($relationship, $table)) {
                continue;
            }
            foreach (['label', 'placeholder', 'field', 'value', 'options'] as $type) {
                $key = $type . "-" . $relationship;
                $value = $content[$key] ?? "";
                unset($content[$key]);
                $file .= "    '" . $key . "' => '" . $value . "',\n";
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
            $file .= "    '" . $key . "' => '" . $value . "',\n";
        }
        $file .= "];\n";
        file_put_contents($filename, $file);
        return 0;
    }
}
