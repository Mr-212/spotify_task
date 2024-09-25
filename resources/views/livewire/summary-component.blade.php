<div class="text-center bg-white">
    <h4>Sumary</h4>
    <div class="row">
        <div class="">
            <label>Role</label>
            <h6>{{ $onboarding?->role }}</h6>
        </div>
        <div class="">
            <label>Country</label>
            <h6>{{ $onboarding?->country }}</h6>
        </div>
        <div class="">
            <label>Address</label>
            <h6>{{ $onboarding?->address }}</h6>
        </div>
        <div class="">
            <label>How did you find US?</label>
            <h6>{{ $onboarding?->address }}</h6>
        </div>
        <div class="">
            <label>Artist Name?</label>
            <h6>{{ $onboarding?->artist?->name }}</h6>
        </div>
    </div>
    <div class="row">
        <div class="">
            <label>Artist Name?</label>
            <h6>{{ $onboarding?->artist?->name }}</h6>
        </div>
        <div class="">
            <label>Followeres</label>
            <h6>{{ $onboarding?->artist?->followers }}</h6>
        </div>
        <div class="">
            <label>Artist Popularity?</label>
            <h6>{{ $onboarding?->artist?->popolarity }}</h6>
        </div>
        <div class="">
            <label>Artist URL?</label>
            <h6>{{ $onboarding?->artist?->url }}</h6>
        </div>
    </div>

</div>
