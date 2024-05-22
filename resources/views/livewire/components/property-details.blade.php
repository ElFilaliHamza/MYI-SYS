<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="container center">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="bed-spinner">How many Bedrooms?</label>
                    <div class="input-group">
                        <button wire:click="decrementBeds" class="btn btn-outline-secondary">-</button>
                        <input wire:model="beds_count" class="form-control text-center" id="bed-spinner" type="text">
                        <button wire:click="incrementBeds" class="btn btn-outline-secondary">+</button>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="bath-spinner">How many Bathrooms?</label>
                    <div class="input-group">
                        <button wire:click="decrementBaths" class="btn btn-outline-secondary">-</button>
                        <input wire:model="baths_count" class="form-control text-center" id="bath-spinner" type="text">
                        <button wire:click="incrementBaths" class="btn btn-outline-secondary">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
