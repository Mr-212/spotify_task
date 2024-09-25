<div>
    <h4></h4>
    <div>
        <ul class="nav nav-tabs gap-y-3">
            <li class="nav-item" >
              <button  wire:click="setActiveTab('url')" class="nav-link {{ $activeTab === 'url' ? 'active' : '' }}" aria-current="page" data-bs-toggle="tab" data-bs-target="#fetch_by_artist_url">Fetch By Artist URL</a>
            </li>
            <li class="nav-item">
              <button wire:click="setActiveTab('name')" class="nav-link {{ $activeTab === 'name' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#fetch_by_artist_name">Fetch by Artist Name</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade {{ $activeTab === 'url' ? 'active show' : '' }}" id="fetch_by_artist_url" role="tabpanel" aria-labelledby="home-tab">
                <label>Artist URL</label>
                <input wire:model="artistURL" type="text" id="fetch_by_artist" class="form-control" placeholder="" />
            </div>
            <div class="tab-pane fade {{ $activeTab === 'name' ? 'active show' : '' }}" id="fetch_by_artist_name" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-body">
                        <label>Artist Name</label>
                        <h5> {{ $artist }} </h5>
                    </div>
                </div>
            </div>
          </div>
    </div>

    <div class="d-flex justify-content-center align-items-center w-full">
        <button type="button" class="btn btn-secondary flex-fill" wire:click='previous'>Previous</button>
        <button type="button" class="btn btn-danger flex-fill" wire:click='next'>Next</button>
    </div>
</div>
