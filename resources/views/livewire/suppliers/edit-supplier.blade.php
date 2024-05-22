<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <form wire:submit.prevent="updateSupplier">
        <div class="modal-header">
            <h4 class="modal-title">Edit Fournisseur</h4>

            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div div class="form-row row">
                <div class="form-group col-md-6 mb-3">
                    <label for="firstName">First Name:</label>
                    <input type="text" wire:model="firstName" id="firstName" placeholder="{{ $firstName }}"
                        class="form-control">
                    @error('firstName')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="lastName">Last Name:</label>
                    <input type="text" wire:model="lastName" id="lastName" class="form-control">
                    @error('lastName')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row row">
                <div class="form-group col-md-12 mb-3">
                    <label for="gender">Gender:</label>
                    <select wire:model="gender" id="gender" class="form-control">
                        <option value="">Select</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    @error('gender')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
                <div class="form-group col-md-6 mb-3">
                    <label for="companyName">Company Name:</label>
                    <input type="text" wire:model="companyName" id="companyName" class="form-control">
                    @error('companyName')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="category">Category:</label>
                    <select wire:model="category" id="category" class="form-control" >
                        <option value="Fournisseur de biens">Fournisseur de biens</option>
                        <option value="Fournisseur de coût">Fournisseur de coût</option>
                    </select>
                    {{-- <input type="text" wire:model="category" id="category"
                                    class="form-control"> --}}
                    @error('category')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
                <div class="form-group mb-3 col-md-12">
                    <label for="agencyName">Agency Name:</label>
                    <input type="text" wire:model="agencyName" id="agencyName" class="form-control">
                    @error('agencyName')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
                <div class="form-group col-md-6 mb-3">
                    <label for="email">Email:</label>
                    <input type="email" wire:model="email" id="email" class="form-control">
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" wire:model="phoneNumber" id="phoneNumber" class="form-control">
                    @error('phoneNumber')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
                <div class="form-group mb-3 col-md-12">
                    <label for="address1">Address 1:</label>
                    <input type="text" wire:model="address1" id="address1" class="form-control">
                    @error('address1')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3 col-md-12">
                    <label for="address2">Address 2:</label>
                    <input type="text" wire:model="address2" id="address2" class="form-control">
                    @error('address2')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
                <div class="form-group mb-3 col-md-6">
                    <label for="country">Country:</label>
                    <input type="text" wire:model="country" id="country" class="form-control">
                    @error('country')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3 col-md-4">
                    <label for="city">City:</label>
                    <input type="text" wire:model="city" id="city" class="form-control">
                    @error('city')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group mb-3 col-md-2">
                    <label for="zip">Zip:</label>
                    <input type="text" wire:model="zip" id="zip" class="form-control">
                    @error('zip')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="form-row row">
                <div class="form-group mb-3 col-md-12">
                    <label for="comments">Comments:</label>
                    <textarea wire:model="comments" id="comments" class="form-control"></textarea>
                    @error('comments')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row row">
            </div>
            <div class="form-row row">
                <div>
                    <label for="accountNumber">Account Number:</label>
                    <input type="text" wire:model="accountNumber" id="accountNumber" class="form-control">
                    @error('accountNumber')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer pt-2 pb-4">
            <button type="button" class="btn btn-outline-danger pr-2" data-bs-dismiss="modal"
                wire:click="$set('modalMode', '')">Fermer</button>
            <button type="submit" class="btn btn-primary">Sauvegarder
                changements</button>
        </div>
    </form>
</div>


