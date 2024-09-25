<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyService
{
    private $redirectUrl;

    private $client_id, $client_secret;
    private $api;
    public function __construct()
    {
        $this->client_id = env('SPOTIFY_CLIENT_ID');
        $this->client_secret = env('SPOTIFY_CLIENT_SECRET');
        $this->redirectUrl =env('SPOTIFY_CALLBACK_URL');
        $this->api = new SpotifyWebAPI();
    }


   private function getSession()
    {
        try{
            if(is_null($this->client_id) || is_null($this->client_secret) || is_null($this->redirectUrl))
            throw new Exception('spotify credentials are null;');

            return  new Session(
                $this->client_id,
                $this->client_secret,
                $this->redirectUrl

            );
        }
        catch(Exception $e)
        {
            Log::error('spotify credentials: '.$e->getMessage());
            return redirect('/exception')->with('error', $e->getMessage());
        }
    }

    public function redirectToSpotify()
    {
        try{

        // pass options for scopes to be requested
            $options = [
                'scope' => [
                    'user-read-email',
                    'user-read-private',
                ],
            ];

            $session = $this->getSession();

            return redirect($session->getAuthorizeUrl($options));
        }
        catch (Exception $ex){

            Log::error('Exception at redirectToSpotify '.$ex->getMessage());

            return redirect('/exception')->with('error', $ex->getMessage());

        }
    }


    public function spotifyCallback($code)
    {
        try
        {
            $session = $this->getSession();

            // Request access token using the code from Spotify
            $session->requestAccessToken($code);

            // Now you can make API calls on behalf of the user

            $this->api->setAccessToken($session->getAccessToken());
            $this->setTokens($session);




            $user = $this->api->me();

            return $user;
        }
        catch(Exception $e)
        {
            Log::error('Exception in Spotify Callback '.$e->getMessage());
            // throw new Exception($e->getMessage());
            return redirect('/exception')->with('error', $e->getMessage());
        }
    }


    public function getArtistInfo($name)
    {
        $this->setAPIClientAccessToken();

        $results = $this->api->search($name,'artist');
        Log::info('Artist Results :\n' . json_encode($results));
        if(!empty($results))
        {
            $result = data_get($results,'artists.items.0');
            // dd($result)

            return $result;
        }

        return null;

    }


    public function getArtistInfoByID($id)
    {
        $this->setAPIClientAccessToken();

        $results = $this->api->getArtist($id);
        // dd($results);

        Log::info('Artist Results :\n' . json_encode($results));
        if(!empty($results))
        {
            // $result = data_get($results,'artists.items.0');

            return $results;
        }

        return null;

    }


    private function setTokens(Session $session)
    {
        session([
            'spotify_access_token' => $session->getAccessToken(),
            'spotify_refresh_token' => $session->getRefreshToken(),
            'spotify_token_expires_in' => now()->addSeconds($session->getTokenExpiration())
        ]);
    }


    private function refreshToken()
    {
        $session = $this->getSession();
        $refresToken = session('spotify_refresh_token');
        $session->refreshAccessToken($refresToken);

        $this->setTokens($session);

    }

    public function checkForTokenExpiration()
    {
        if(session('spotify_token_expires_in') && now()->greaterThan(session('spotify_token_expires_in')))
        {
            $this->refreshToken();
        }

    }

    private function setAPIClientAccessToken()
    {
        $this->checkForTokenExpiration();
        $this->api->setAccessToken(Session('spotify_access_token'));
    }
}
