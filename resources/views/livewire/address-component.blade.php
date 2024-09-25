<div class="text-center gap-4">

    <div class="row">
        <h4 class="text-white">Where are you located ?</h4>
        <p class="text-white text-small">Adresses are being fecthed from API (https://nominatim.openstreetmap.org/search) beacuse of requesting from localhost or location it sometimes blocks otherwise works and tested<p>

        <div>
            <input type="text"  class="form-control form-control-sm" placeholder="Search Country"  wire:model.live='countrySearchTerms' />
        @if (!empty($countries))
        <ul class="list-group">
            @foreach ($countries as $country)
                <li class="list-group-item" wire:click="selectCountry('{{ $country }}')">{{ $country }}</li>
            @endforeach
        </ul>
        @endif

        @if($showAddress)
        <input type="text"  class="form-control form-control-sm" placeholder="Address"  wire:model.live='addressSearchTerms'/>

            @if (!empty($addresses))
                <ul class="list-group">
                @foreach ($addresses as $address)
                    <li class="list-group-item" wire:click="selectAddress('{{ $address }}')">{{ $address }}</li>
                @endforeach
                </ul>
            @endif

        @endif
    </div>
    <div class="d-flex justify-content-center align-items-center w-full">
        <button type="button" class="btn btn-secondary flex-fill" wire:click='previous'>Previous</button>
        <button type="button" class="btn btn-danger flex-fill {{ $enableNext ? '': 'disabled'}}" wire:click='next'>Next</button>
    </div>





</div>

</div>
