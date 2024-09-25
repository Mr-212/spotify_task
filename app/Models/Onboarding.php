<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
    use HasFactory;


    const ROLE_MANAGER = 'MANAGER';
    const ROLE_USER = 'USER';


    protected $fillable = ['role', 'country', 'address','hear_about_us'];

    public static function getRoles(): array
    {
        return [
            self::ROLE_MANAGER,
            self::ROLE_USER
        ];
    }


    public function artist()
    {
        return $this->belongsTo(SpotifyArtist::class,'id','onboarding_id');
    }


    public static function updateArtistData($onboardingid, $artistData)
    {
        $artist = self::find($onboardingid);
    }
}
