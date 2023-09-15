<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Table extends Component
{
    public $fields;
    public $items;
    protected $translate;
    protected $model;
    public $sorting;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(iterable $fields, iterable $items, $model, string $translate = null, iterable $sorting = null)
    {
        $this->fields = $fields;
        $this->items = $items;
        $this->translate = $translate;

        $class = '';
        if (null !== $model && is_object($model)) {
            $class = Str::of(class_basename($model))->lower();
        } elseif (null !== $model && class_exists($model, true)) {
            $class = Str::of(class_basename($model))->lower();
        } elseif (null !== $model && class_exists("App\\Models\\".$model, true)) {
            $class = Str::of(class_basename($model))->lower();
        }

        switch ($this->translate) {
            case 'fields':
                $newFields = [];
                foreach ($fields as $field) {
                    $newFields[$field] = ['field' => $field, 'title' => __($class.'.label-'.$field, [], 'sv'), 'class' => $sorting[$field] ?? ''];
                }
                $this->fields = $newFields;
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table');
    }
}
