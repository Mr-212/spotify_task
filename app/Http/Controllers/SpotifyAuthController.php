<?php

namespace App\Http\Controllers;

use App\Services\SpotifyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpotifyAuthController extends Controller
{
    //

    public function __construct(private SpotifyService $spotifyService)
    {

    }

    /*
    @description: after succesfully retriving user information we redirect to Spotify Callback Process Component with status and handle artist fetching.
    *
    */
    public function callback(Request $request)
    {
        try
        {
            $status = "FAILED";
            $code = $request->get("code");

            $user = $this->spotifyService->spotifyCallback($code);

            if($user?->id)
            {
                $status = "Success";

                return redirect("/onboarding/spotify_handle_callback/{$status}");
            }

        }
        catch(Exception $e)
        {
            Log::error('Exception occured while authenticating: \n' . $e->getMessage());

            return redirect('/exception')->with('error', $e->getMessage());
            // throw new Exception($e->getMessage());
        }

        return redirect("/onboarding/spotify_handle_callback/{$status}");


    }


    public function error(Request $request)
    {
        return view("error",['error' =>$request->get('error')]);
    }
}
