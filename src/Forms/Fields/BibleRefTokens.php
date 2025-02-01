<?php
namespace AscentCreative\BibleRef\Forms\Fields;

use AscentCreative\Forms\Contracts\FormComponent;
use AscentCreative\Forms\FormObjectBase;
use AscentCreative\Forms\Traits\CanBeValidated;
use AscentCreative\Forms\Traits\CanHaveValue;


class BibleRefTokens extends FormObjectBase implements FormComponent {

    use CanBeValidated, CanHaveValue;

    public $component = 'bibleref-fields-biblereftokens';

    public function __construct($name, $label=null) {
        $this->name = $name;
        $this->label = $label;
    }
    

}