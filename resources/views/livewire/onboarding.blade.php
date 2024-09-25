<div class="text-center">
     <h4 class="text-white">Select an Account Role</h4>
        <select class="form-control form-control-sm" name="role" id="role"  wire:model='role'>

            @foreach ($roles as $role )

                <option value="{{ $role }}"> {{ $role }}</option>

            @endforeach

        </select>

        <div class="d-flex justify-content-center align-items-center w-full">
            {{-- <button type="button" class="btn btn-secondary flex-fill" wire:click='previous'>Previous</button> --}}
            <button type="button" class="btn btn-danger flex-fill" wire:click='next'>Next</button>
        </div>
        {{-- <button type="btn btn-primary" wire:click='previous'>Previous</button> --}}
</div>
