<?php

namespace App\Livewire;

use App\Models\Onboarding;
use App\Services\CountryLocationService;
use Livewire\Component;

class AddressComponent extends Component
{

    public $countrySearchTerms, $countries, $address, $addressSearchTerms, $addresses;
    public $onboardingId;
    public $showAddress, $enableNext = false;
    public $onboardingModel;
    public function render()
    {
        return view('livewire.address-component');
    }

    public function mount($onboardingId)
    {
        $this->showAddress = false;
        $this->onboardingId = $onboardingId;
        $this->onboardingModel = Onboarding::find($onboardingId);
        $this->countrySearchTerms = $this->onboardingModel->country;
        $this->addressSearchTerms = $this->onboardingModel->address;
        $this->enableNext = is_null($this->countrySearchTerms) || is_null($this->addressSearchTerms) ? false : true;
        $this->showAddress = is_null($this->countrySearchTerms) ? false : true;
    }



    //on input country will serch country throug API
    public function updatedCountrySearchTerms()
    {
        if(empty($this->countrySearchTerms)) return;

        $countryAddressService = new CountryLocationService();

        $this->countries = $countryAddressService->countries($this->countrySearchTerms);

    }


    public function selectCountry($value)
    {
        $this->countrySearchTerms = $value;
        $this->countries = [];

        $this->showAddress = true;

        Onboarding::where('id', $this->onboardingId)->update(['country' => $this->countrySearchTerms]);
    }



    //on input address will search address throug API
    public function updatedAddressSearchTerms()
    {
        if(empty($this->addressSearchTerms)) return;

        $countryAddressService = new CountryLocationService();

        $this->addresses = $countryAddressService->address($this->addressSearchTerms);

    }


    public function updated()
    {
        if($this->countrySearchTerms && $this->addressSearchTerms)
        $this->enableNext = true;

    }


    public function selectAddress($value)
    {
        $this->addressSearchTerms = $value;
        $this->addresses = [];
        $this->enableNext = true ;
        Onboarding::where('id', $this->onboardingId)->update(['address' => $this->addressSearchTerms]);
    }


    public function next()
    {
        return redirect("/onboarding/aboutus/{$this->onboardingId}");
    }

    public function previous()
    {
        return redirect("/onboarding/role/{$this->onboardingId}");
    }

}
