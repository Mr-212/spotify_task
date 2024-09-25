<?php

namespace App\Livewire;

use App\Models\Onboarding;
use Livewire\Component;

class HearAboutComponent extends Component
{

    public $hearAbout =  'Songwriter Accelrator Programme', $onboardingID, $onboardingModel;


    public function mount($onboardingId)
    {
        $this->onboardingID = $onboardingId;
        $this->onboardingModel = Onboarding::find($onboardingId);
        $this->hearAbout = $this->onboardingModel->hear_about_us?? 'Songwriter Accelrator Programme';
    }


    // public function updatedHearAbout($value)
    // {
    //     dd($value);
    // }
    public function render()
    {
        return view('livewire.hear-about-us-component', ['options' => $this->optionsArray()]);
    }


    public function optionsArray()
    {
        return [
            'Songwriter Accelrator Programme',
            'Other'
        ];
    }



    public function next()
    {
        if($this->hearAbout)
        {
            Onboarding::where('id', $this->onboardingID)->update(['hear_about_us' => $this->hearAbout]);

            return redirect("/onboarding/spotify_artist/{$this->onboardingID}");
        }


    }


    public function previous()
    {
        return redirect("/onboarding/address/{$this->onboardingID}");
    }



}
