<?php

namespace App\Livewire;

use App\Models\SpotifyArtist;
use App\Services\SpotifyService;
use Livewire\Component;
use App\Models\Onboarding;

class SpotifyArtistComponent extends Component
{

    public $artist, $onboardingId, $onboardingModel;


    public function mount($onboardingId = null)
    {
        $this->onboardingId = $onboardingId;
        $this->onboardingModel = Onboarding::find($onboardingId);
        $this->artist = $this->onboardingModel->artist?->name;

    }
    public function render()
    {
        return view('livewire.spotify-artist-component');
    }


    public function next()
    {
        if($this->artist)
        {
            SpotifyArtist::updateOrCreate(['onboarding_id' => $this->onboardingId],[ 'name' => $this->artist ]);
            return redirect("/onboarding/spotify_artist_fetch/{$this->onboardingId}/{$this->artist}");
        }

    }

    public function previous()
    {
        return redirect("/onboarding/aboutus/{$this->onboardingId}");

    }
}
