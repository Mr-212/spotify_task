<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyArtist extends Model
{
    use HasFactory;


    protected $fillable = [ 'name', 'genere', 'popolarity' ,'data' ,'onboarding_id','spotify_id','url', 'followers'];


    public function onboarding()
    {
        return $this->hasOne(Onboarding::class,'onboarding_id');
    }
}
