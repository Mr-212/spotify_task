<?php

namespace App\Livewire;

use App\Models\Onboarding;
use App\Services\SpotifyService;
use Livewire\Component;

class SpotifyCallbackProcessComponent extends Component
{


    public $status, $OnboardingId;
    static $STATUS_SUCCESS = 'Success';
    public function mount($status)
    {
        $this->status = $status;
        $this->process_artist_fetching();
    }
    public function render()
    {
        return view('livewire.spotify-callback-component');
    }

    /* After authentication from spotify auth controller it redirects to this page and process of fetching and updating artist executed.*/
    private function process_artist_fetching()
    {
        $onboardingID = session()->get('onboarding_id');
        $this->OnboardingId =  $onboardingID;
        if($this->status == static::$STATUS_SUCCESS && session()->has('artist'))
        {
            $spotifyService = new SpotifyService();
            $artist = session()->get('artist');
            $artistData = $spotifyService->getArtistInfo($artist);

            $this->updateResults($this->OnboardingId, $artistData);
            session()->forget('artist');



        }
        if($this->status == static::$STATUS_SUCCESS && session()->has(key: 'artist_url'))
        {
            $spotifyService = new SpotifyService();
            $artist_url = session()->get('artist_url');

            $spotify_id = $this->getArtistIDFromURL($artist_url);
            $artistData = $spotifyService->getArtistInfoByID($spotify_id);
            // $onboardingID = session()->get('onboarding_id');
            $this->updateResults($this->OnboardingId, $artistData);
             session()->forget('artist_url');
        }


    }


    private function updateResults($onboardingID, $artistData)
    {

            if($onboardingID)
            {
                $onboarding = Onboarding::find($onboardingID);
                $onboarding->artist->update(
                    [
                        'spotify_id' => data_get($artistData,'id'),
                        'url' => data_get($artistData,'href'),
                        'popolarity' => data_get($artistData,'popularity'),
                        'followers' => data_get($artistData,'followers.total')
                ]);
            }

    }


    private function getArtistIDFromURL($url)
    {
            return basename($url);
    }


    public function next()
    {
        return redirect("/onboarding/summary/{$this->OnboardingId}");
    }
    // public function previous()
    // {
    //     return redirect("/summary/{$this->OnboardingId}");
    // }






}
