<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AnswerFeedback extends Component
{
    //data yang akan kita passing
    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.answer-feedback');
    }
}
