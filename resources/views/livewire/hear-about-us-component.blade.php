<div>

    <h3 class="text-white">How did you hear about us?</h3>
    <select class="form-control form-control-sm" name="about-us" wire:model='hearAbout'>

        @if($options)

            @foreach ($options as $opt )
                <option value="{{ $opt }}"> {{ $opt }} </option>
            @endforeach

        @endif

    </select>

    <div class="d-flex justify-content-center align-items-center w-full">
        <button type="button" class="btn btn-secondary flex-fill" wire:click='previous'>Previous</button>
        <button type="button" class="btn btn-danger flex-fill" wire:click='next'>Next</button>
    </div>

</div>
