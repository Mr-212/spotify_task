<?php

namespace App\Livewire;

use App\Services\SpotifyService;
use Exception;
use Livewire\Component;

class ArtistFetchComponent extends Component
{

    public $artist, $onboardingId, $artistURL, $activeTab = 'url';
    public function mount($onboardingId, $artist)
    {
        $this->onboardingId = $onboardingId;
        $this->artist = $artist;
    }
    public function render()
    {
        return view('livewire.artist-fetch-component');
    }


    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }


    public function next()
    {
        try
        {
            if(session()->has('artist')) session()->forget('artist');
            if(session()->has('artist_id')) session()->forget('artist_id');

            if($this->artist)
            {
            if($this->activeTab == 'url' && !empty($this->artistURL))
                session(['artist_url' => $this->artistURL, 'onboarding_id' => $this->onboardingId]);
            if($this->activeTab == 'name')
                session(['artist' => $this->artist, 'onboarding_id' => $this->onboardingId]);



            $spotifyService = new SpotifyService();
            $spotifyService->redirectToSpotify();
            }
        }
        catch(Exception $e)
        {
            // throw new Exception($e->getMessage());
        }

    }


    public function previous()
    {
        return redirect("/onboarding/spotify_artist/{$this->onboardingId}");
    }
}
