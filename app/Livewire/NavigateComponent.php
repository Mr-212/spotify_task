<?php

namespace App\Livewire;

use Livewire\Component;

class NavigateComponent extends Component
{

    public $nexturl, $previousurl;


    public function mount($onboardingId, $nextUrl, $previousUrl)
    {
        $this->nexturl = $nextUrl . '/' .$onboardingId;

        $this->previousurl = $previousUrl . '/' . $onboardingId;
    }
    public function render()
    {
        return view('livewire.navigate-component');
    }
}
