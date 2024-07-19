<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public ?bool $allOption = true,
        public ?string $value = null
        // array ['entry','intermediate]
        //associative array: ['Entry'=>'entry','Intermediate'=>'intermediate']
    ) {
        //
    }

    // define a method to make optiions with labels into associative array and make it uppercase
    public function optionsWithLabels()
    {
        // array_is_list() it will tell us if the array is not associative
        //? if yes (means its not associative) array_combine() will make it associative
        //: if not (means its associative) will  return just the array
        return array_is_list($this->options) ?
            array_combine($this->options, $this->options)
            : $this->options;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
