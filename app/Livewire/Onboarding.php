<?php

namespace App\Livewire;

use App\Models\Onboarding as OnboardingModel;
use App\Models\User;
use Livewire\Component;

class Onboarding extends Component
{


    public $role = OnboardingModel::ROLE_MANAGER, $onboardingId = null;
    protected $rules = [
        'role' => 'required',
    ];
    public function render()
    {
        return view('livewire.onboarding',[ 'roles' => $this->roles()]);
    }


    public function mount()
    {

    }


    /* get roles from user model */
    public function roles()
    {
        return OnboardingModel::getRoles();
    }


    public function next()
    {
        $this->validate($this->rules);

        if(is_null($this->onboardingId))
        {
            $onboarding  = OnboardingModel::create([ 'role' => $this->role ]);

            $this->onboardingId = $onboarding->id;


        }

        return redirect("/onboarding/address/{$this->onboardingId}");


    }


}
