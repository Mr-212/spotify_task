<?php

use App\Http\Controllers\SpotifyAuthController;
use App\Livewire\AddressComponent;
use App\Livewire\ArtistFetchComponent;
use App\Livewire\ExceptionComponent;
use App\Livewire\HearAboutComponent;
use App\Livewire\Onboarding;
use App\Livewire\SpotifyArtistComponent;
use App\Livewire\SpotifyCallbackProcessComponent;
use App\Livewire\SummaryComponent;
use App\Models\SpotifyArtist;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\ExceptionCode;

//commented out old default welcome route

Route::get('/', function () {
    return redirect('/onboarding/role');
});

Route::prefix('onboarding')->group(function () {
    Route::get('/role/{onboardingId?}', Onboarding::class);
    Route::get('/address/{onboardingId?}', AddressComponent::class);
    Route::get('/aboutus/{onboardingId?}', HearAboutComponent::class);
    Route::get('/spotify_artist/{onboardingId?}', SpotifyArtistComponent::class);
    Route::get('/spotify_handle_callback/{status?}', SpotifyCallbackProcessComponent::class);
    Route::get('/spotify_artist_fetch/{onboardingId?}/{artist?}', ArtistFetchComponent::class);
    Route::get('/summary/{onboardingId?}', SummaryComponent::class);
});

// routing home url to Oboarding component livewire

Route::get('/exception', ExceptionComponent::class);


Route::get('/spotify_callback/{code?}', [SpotifyAuthController::class,  'callback' ]);
// Route::get('/error', [SpotifyAuthController::class,  'error' ]);

