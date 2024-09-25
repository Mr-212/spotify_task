<?php

namespace App\Livewire;

use Livewire\Component;

class ExceptionComponent extends Component
{
    public $exception;


    public function mount()
    {
        $exception = session('error');
        $this->exception = $exception;
    }
    public function render()
    {
        return view('livewire.exception-component');
    }
}
