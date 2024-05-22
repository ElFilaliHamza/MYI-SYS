<div>
    {{-- ======================= POP UP modify USER ========================== --}}
                {{-- FORM --}}
                <form>
                    <div class="modal-header pb-2">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Edit Client : <code>{{$firstName . ' ' . $lastName}}</code></h1>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">

                        {{-- first and last name --}}
                        <div class="form-row row">
                            <div class="form-group col-md-6 mb-2">
                                <label for="">Prenom</label>
                                <input type="text" class="form-control" id="" wire:model="firstName"
                                    placeholder="Entrer le prenom">
                                @error('firstName')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" wire:model="lastName"
                                    placeholder="Entrer le nom">
                                @error('lastName')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- genre --}}
                        <div class="form-row row">

                            <div class="form-group mb-2">
                                <label for="gender">Genre:</label>
                                <select class="form-control" wire:model="gender">
                                    <option value="1">Masculin</option>
                                    <option value="0">Féminin</option>
                                </select>
                                @error('')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Telephone --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">Telephone</label>
                                <input type="number" class="form-control" wire:model="phoneNumber"
                                    placeholder="Entrer le numero Telephone">
                                @error('phoneNumber')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">Email</label>
                                <input type="email" class="form-control" wire:model="email"
                                    placeholder="Entrer l'email">
                                @error('email')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Adresse --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">address 1</label>
                                <input type="text" class="form-control" wire:model="address1"
                                    placeholder="Entrer l'adresse 1">
                                @error('address1')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">address2</label>
                                <input type="text" class="form-control" wire:model="address2"
                                    placeholder="Entrer l'adresse 2">
                                @error('')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- pays, ville, code postal --}}
                        <div class="form-row row">
                            <div class="form-group col-md-5 mb-2">
                                <label for="">pays</label>
                                <input type="text" class="form-control" wire:model="country"
                                    placeholder="Entrer la pays">
                                @error('country')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-2">
                                <label for="">ville</label>
                                <input type="text" class="form-control" wire:model="city"
                                    placeholder="Entrer la ville">
                                @error('city')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label for="">code postal</label>
                                <input type="number" class="form-control" wire:model="zip"
                                    placeholder="Entrer le code postal">
                                @error('zip')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- comments --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">commentaire</label>
                                <input type="text" class="form-control" wire:model="comments"
                                    placeholder="Entrer le commentaire">
                                @error('lastName')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- entreprise name --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">Nom de l'entreprise</label>
                                <input type="text" class="form-control" wire:model="companyName"
                                    placeholder="Entrer le nom d'entreprise">
                                @error('companyName')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- numero de compte --}}
                        <div class="form-row row">
                            <div class="form-group mb-2">
                                <label for="">Numero de compte:</label>
                                <input type="text" class="form-control" wire:model="accountNumber"
                                    placeholder="Entrer le num de compte">
                                @error('accountNumber')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- package --}}
                        <div class="form-row row">
                            <div>
                                <label for="">Selectionne package :</label>

                                <select class="form-control" wire:model="selectedPackage">
                                    <option class="form-control" value="">Sélectionnez un package
                                    </option>
                                    @foreach ($packages as $package)
                                        <option class="form-control" value="{{ $package->id }}">
                                            {{ $package->package_name }}</option>
                                    @endforeach

                                </select>
                                @error('')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer pt-2 pb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            wire:click='create'>Add changes</button>
                    </div>
                </form>
                {{-- END FORM --}}
    {{-- =======================END POP UP modify USER ========================== --}}
</div>
