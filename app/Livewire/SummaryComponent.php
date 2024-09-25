<?php

namespace App\Livewire;

use App\Models\Onboarding;
use Livewire\Component;

class SummaryComponent extends Component
{

    public $onboardingId, $onboarding;
    public function mount($onboardingId = null)
    {
        $this->onboardingId = $onboardingId;
        $this->onboarding = Onboarding::find($onboardingId);
        // dd($this->onboarding);
    }
    public function render()
    {
        return view('livewire.summary-component');
    }
}
