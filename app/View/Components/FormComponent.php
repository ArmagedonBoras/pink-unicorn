<?php

namespace App\View\Components;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Throwable;

abstract class FormComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public $value = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $type = null,
        public ?string $divClass = '',
        public ?string $inputClass = '',
        public ?iterable $options = null,
        public int $inline = 0,
        public ?string $translate = '',
        public $translateReplace = [],
        public ?string $optionsModel = null,
        public ?string $optionsModelField = null,
        public string $link = '',
        public string $comment = '',
        public ?string $min = null,
        public ?string $max = null,
        public ?string $step = null,
        public $model = null,
        public ?string $optionsBuilderField = '',
        public ?string $interpolator = null,
        public ?Collection $optionsBuilder = null,
    ) {
        $this->required = ($required == 1 || $required == 'true');
        $this->disabled = ($disabled == 1 || $disabled == 'true');

        $class = '';
        if (null !== $model && is_object($model)) {
            $class = Str::of(class_basename($model))->lower();
            $this->value = $value ?? ($model->$name ?? '');
            $this->label = $label ?? __($class.".label-".$name, [], 'sv');
            $this->placeholder = $placeholder ?? __($class.".placeholder-".$name, [], 'sv');
        } elseif (null !== $model && class_exists($model, true)) {
            $class = Str::of(class_basename($model))->lower();
            $this->label = $label ?? __($class.".label-".$name, [], 'sv');
            $this->placeholder = $placeholder ?? __($class.".placeholder-".$name, [], 'sv');
        }

        if (null !== $this->type) { // && in_array($this->type, ['radio', 'select', 'checkbox']) ??
            $this->options = $this->options ?? Tag::ofType($this->type)->pluck('label', 'id');
        }
        if (null !== $this->optionsModel && null !== $this->optionsModelField) {
            $this->options = $this->options ?? $this->optionsModel::all()->pluck($this->optionsModelField, 'id');
        }
        if (null !== $this->optionsBuilder && $this->optionsBuilder->count() > 0) {
            $this->options = $this->options ?? $this->buildOptions($this->optionsBuilder, $class);
        }

        $this->boot();
        $this->translate($class);
    }

    protected function boot()
    {
    }

    protected function tryToArray($replace)
    {
        $translateArray = [];
        if (is_object($replace)) {
            try {
                $translateArray = $replace->attributesToArray();
            } catch (Throwable $e) {
            }
            if (!empty($translateArray)) {
                return $translateArray;
            }
            try {
                $translateArray = $replace->toArray();
            } catch (Throwable $e) {
            }
            return $translateArray;
        }
    }

    protected function buildOptions(Collection $collection, $class)
    {
        $options = [];
        $idField = $this->optionsBuilderField ?? 'id';
        $collection->each(function ($item) use ($class, &$options, $idField) {
            $translateArray = $this->tryToArray($item);
            $id = $translateArray[$idField] ?? $translateArray['id'];
            $interpolator = $this->interpolator ?? $class.'.options-'.$this->name;
            $options[$id] = __($interpolator, $translateArray, 'sv');
        });
        return $options;
    }

    protected function translate($class)
    {
        if (is_array($this->translateReplace)) {
            $translateArray = $this->translateReplace;
        } elseif (is_object($this->translateReplace)) {
            $translateArray = $this->tryToArray($this->translateReplace);
        }

        switch ($this->translate) {
            case 'value':
                $interpolator = $this->interpolator ?? $class.'.value-'.$this->value;
                $this->value = __($interpolator, $translateArray, 'sv');
                break;

            case 'field':
                $interpolator = $this->interpolator ?? $class.'.field-'.$this->name;
                $this->value = __($interpolator, $translateArray, 'sv');
                break;

            case 'option':
                $options = [];
                foreach ($this->options as $key => $option) {
                    $options[$option] = __($class.'.option-'.$option, [], 'sv');
                }
                $this->options = $options;
                break;
            case null:
                break;

            default:
                $this->value = __($this->translate, $translateArray, 'sv');
                break;
        }
    }
}
