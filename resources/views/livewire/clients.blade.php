<div>
    {{-- Full CARD --}}
    <div class="card">
        <div class="card-body">
            {{-- header of the card --}}
            <div class="row conteneur">
                <div class="col-6">
                    <h1 class="card-title mb-2">Clients</h1>
                </div>
                {{-- <div class=" col-4">
                    <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher employee">
                </div> --}}
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                        data-bs-target="#exampleModal" wire:model.live="search">
                        Ajouter
                    </button>
                </div>
            </div>
            <div class="conteneur pb-2 pt-2">
                <div class="col-8">
                    {{-- <p>Table des clients <code> </code></p> --}}
                    {{-- <p class="lead">Table des clients</p> --}}
                    {{-- <p>Employé connecté : <code> {{ $authenticatedUserName }} </code></p> --}}
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher client">
                </div>
                {{-- <search /> --}}
            </div>
            <div class="row conteneur m-1">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            {{-- table of date --}}
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Courriel</th>
                            <th>Téléphone</th>
                            <th>Dépenses totales</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($customers != null)
                            @foreach ($customers as $customer)
                                <tr wire:key='{{ $customer->id }}'>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->person->first_name }}</td>
                                    <td>{{ $customer->person->last_name }}</td>
                                    <td>{{ $customer->person->email }}</td>
                                    <td>{{ $customer->person->phone_number }}</td>
                                    <td>{{ $customer->person->first_name }}</td>
                                    <td>
                                        {{-- <a href="{{ route('client.edit', $customer->id) }}" class="mr-2"><i
                                                class="fa fa-edit text-primary font-18 dz-size1"></i></a> --}}
                                        <a class="mr-2">
                                            <i class="fa fa-edit text-primary font-18 dz-size1"
                                                wire:click='edit({{ $customer->id }})' data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit"></i></a>
                                        <a href="#" wire:confirm='you are sure for deleting this cutomer'
                                            wire:click='destroy({{ $customer->id }})'><i
                                                class="fa fa-trash text-danger font-18"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>There's no data yet</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $Customers->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    {{-- ======================= POP UP Add USER ========================== --}}
    <div wire:loading class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">



                {{-- FORM --}}
                <form>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            {{ $formTitle }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- first and last name --}}
                        <div class="form-row row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="">Prenom</label>
                                <input type="text" class="form-control" id="" wire:model="firstName"
                                    placeholder="Entrer le prenom">
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" wire:model="lastName"
                                    placeholder="Entrer le nom">
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- genre --}}
                        <div class="form-row row">

                            <div class="form-group mb-3">
                                <label for="gender">Genre:</label>
                                <select class="form-control" wire:model="gender">
                                    <option value="1">Masculin</option>
                                    <option value="0">Féminin</option>
                                </select>
                                @error('')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Telephone --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">Telephone</label>
                                <input type="number" class="form-control" wire:model="phoneNumber"
                                    placeholder="Entrer le numero Telephone">
                                @error('phoneNumber')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" wire:model="email"
                                    placeholder="Entrer l'email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Adresse --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">address 1</label>
                                <input type="text" class="form-control" wire:model="address1"
                                    placeholder="Entrer l'adresse 1">
                                @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">address2</label>
                                <input type="text" class="form-control" wire:model="address2"
                                    placeholder="Entrer l'adresse 2">
                                @error('')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- pays, ville, code postal --}}
                        <div class="form-row row">
                            <div class="form-group col-md-5 mb-3">
                                <label for="">pays</label>
                                <input type="text" class="form-control" wire:model="country"
                                    placeholder="Entrer la pays">
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="">ville</label>
                                <input type="text" class="form-control" wire:model="city"
                                    placeholder="Entrer la ville">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 mb-3">
                                <label for="">code postal</label>
                                <input type="number" class="form-control" wire:model="zip"
                                    placeholder="Entrer le code postal">
                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- comments --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">commentaire</label>
                                <input type="text" class="form-control" wire:model="comments"
                                    placeholder="Entrer le commentaire">
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- entreprise name --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">Nom de l'entreprise</label>
                                <input type="text" class="form-control" wire:model="companyName"
                                    placeholder="Entrer le nom d'entreprise">
                                @error('companyName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- numero de compte --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="">Numero de compte:</label>
                                <input type="text" class="form-control" wire:model="accountNumber"
                                    placeholder="Entrer le num de compte">
                                @error('accountNumber')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- package --}}
                        <div class="form-row row">
                            <div>
                                <select class="form-control" wire:model="selectedPackage">
                                    <option class="form-control" value="">Sélectionnez un package
                                    </option>
                                    @foreach ($packages as $package)
                                        <option class="form-control" value="{{ $package->id }}">
                                            {{ $package->package_name }}</option>
                                    @endforeach

                                </select>
                                @error('')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            wire:click='create'>Add changes</button>
                    </div>
                </form>
                {{-- END FORM --}}
            </div>
        </div>
    </div>
    {{-- ======================= END POP UP Add USER ========================== --}}

    {{-- ======================= POP UP modify USER ========================== --}}
    <div wire:ignore.self class="modal fade" id="ModalEdit" aria-labelledby="ModalEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                @if ($selectedCustomerId)
                    {{-- FORM --}}
                    <form>
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">
                                {{ $formTitle }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            {{-- first and last name --}}
                            <div class="form-row row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="">Prenom</label>
                                    <input type="text" class="form-control" id="" wire:model="firstName"
                                        placeholder="Entrer le prenom">
                                    @error('firstName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control" wire:model="lastName"
                                        placeholder="Entrer le nom">
                                    @error('lastName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- genre --}}
                            <div class="form-row row">

                                <div class="form-group mb-3">
                                    <label for="gender">Genre:</label>
                                    <select class="form-control" wire:model="gender">
                                        <option value="1">Masculin</option>
                                        <option value="0">Féminin</option>
                                    </select>
                                    @error('')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Telephone --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">Telephone</label>
                                    <input type="number" class="form-control" wire:model="phoneNumber"
                                        placeholder="Entrer le numero Telephone">
                                    @error('phoneNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- email --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" wire:model="email"
                                        placeholder="Entrer l'email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Adresse --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">address 1</label>
                                    <input type="text" class="form-control" wire:model="address1"
                                        placeholder="Entrer l'adresse 1">
                                    @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">address2</label>
                                    <input type="text" class="form-control" wire:model="address2"
                                        placeholder="Entrer l'adresse 2">
                                    @error('')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- pays, ville, code postal --}}
                            <div class="form-row row">
                                <div class="form-group col-md-5 mb-3">
                                    <label for="">pays</label>
                                    <input type="text" class="form-control" wire:model="country"
                                        placeholder="Entrer la pays">
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="">ville</label>
                                    <input type="text" class="form-control" wire:model="city"
                                        placeholder="Entrer la ville">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3 mb-3">
                                    <label for="">code postal</label>
                                    <input type="number" class="form-control" wire:model="zip"
                                        placeholder="Entrer le code postal">
                                    @error('zip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- comments --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">commentaire</label>
                                    <input type="text" class="form-control" wire:model="comments"
                                        placeholder="Entrer le commentaire">
                                    @error('lastName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- entreprise name --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">Nom de l'entreprise</label>
                                    <input type="text" class="form-control" wire:model="companyName"
                                        placeholder="Entrer le nom d'entreprise">
                                    @error('companyName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- numero de compte --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="">Numero de compte:</label>
                                    <input type="text" class="form-control" wire:model="accountNumber"
                                        placeholder="Entrer le num de compte">
                                    @error('accountNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- package --}}
                            <div class="form-row row">
                                <div>
                                    <select class="form-control" wire:model="selectedPackage">
                                        <option class="form-control" value="">Sélectionnez un package
                                        </option>
                                        @foreach ($packages as $package)
                                            <option class="form-control" value="{{ $package->id }}">
                                                {{ $package->package_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                wire:click='update'>Add changes</button>
                        </div>
                    </form>
                    {{-- END FORM --}}
                @endif
                {{-- END FORM --}}
            </div>
        </div>
    </div>
    {{-- =======================END POP UP modify USER ========================== --}}


</div>
