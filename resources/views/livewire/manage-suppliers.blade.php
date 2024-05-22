<div>
    <div class="row">
        <div class="col-12 box-margin">
            <div class="card">
                <div class="card-body">



                    {{-- ======================= POP UP ADD USER ========================== --}}
                    <!-- Button trigger modal -->
                    {{-- <div class="conteneur">
                        <h1 class="card-title mb-2">Fournisseur</h1>
                        <div class="conteneur-button ">
                            <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Ajouter fournisseur
                            </button>
                            <input type="text" class="form-control" type="text" wire:model.live="search"
                                placeholder="Search suppliers..." aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                            <input class="form-control" type="text" wire:model.live="search" placeholder="Search suppliers...">
                            
                        </div>
                    </div> --}}
                    <div class="row conteneur">
                        <div class="col-6">
                            <h1 class="card-title mb-2">Fournisseur</h1>
                        </div>
                        {{-- <div class=" col-4">
                            <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher employee">
                        </div> --}}
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                                data-bs-target="#exampleModal" wire:model.live="search">
                                Ajouter fournisseur
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
                            <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher fournisseur">
                        </div>
                        {{-- <search /> --}}
                    </div>
                    
                    <!-- Modal -->
                    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form wire:submit.prevent="save">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Modal
                                            title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div div class="form-row row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="firstName">First Name:</label>
                                                <input type="text" wire:model.live="firstName" id="firstName"
                                                    placeholder="{{ $firstName }}" class="form-control">
                                                @error('firstName')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="lastName">Last Name:</label>
                                                <input type="text" wire:model.live="lastName" id="lastName"
                                                    class="form-control">
                                                @error('lastName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row row">
                                            <div class="form-group col-md-12 mb-3">
                                                <label for="gender">Gender:</label>
                                                <select wire:model.live="gender" id="gender" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>
                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="companyName">Company Name:</label>
                                                <input type="text" wire:model.live="companyName" id="companyName"
                                                    class="form-control">
                                                @error('companyName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="category">Category:</label>
                                                <select wire:model.live="category" id="category" class="form-control">
                                                    <option value="Fournisseur de biens">Fournisseur de biens</option>
                                                    <option value="Fournisseur de coût">Fournisseur de coût</option>
                                                </select>
                                                {{-- <input type="text" wire:model.live="category" id="category"
                                    class="form-control"> --}}
                                                @error('category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group mb-3 col-md-12">
                                                <label for="agencyName">Agency Name:</label>
                                                <input type="text" wire:model.live="agencyName" id="agencyName"
                                                    class="form-control">
                                                @error('agencyName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="email">Email:</label>
                                                <input type="email" wire:model.live="email" id="email"
                                                    class="form-control">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="phoneNumber">Phone Number:</label>
                                                <input type="text" wire:model.live="phoneNumber" id="phoneNumber"
                                                    class="form-control">
                                                @error('phoneNumber')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group mb-3 col-md-12">
                                                <label for="address1">Address 1:</label>
                                                <input type="text" wire:model.live="address_1" id="address1"
                                                    class="form-control">
                                                @error('address1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3 col-md-12">
                                                <label for="address2">Address 2:</label>
                                                <input type="text" wire:model.live="address_2" id="address2"
                                                    class="form-control">
                                                @error('address2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group mb-3 col-md-6">
                                                <label for="country">Country:</label>
                                                <input type="text" wire:model.live="country" id="country"
                                                    class="form-control">
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3 col-md-4">
                                                <label for="city">City:</label>
                                                <input type="text" wire:model.live="city" id="city"
                                                    class="form-control">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3 col-md-2">
                                                <label for="zip">Zip:</label>
                                                <input type="text" wire:model.live="zip" id="zip"
                                                    class="form-control">
                                                @error('zip')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-row row">
                                            <div class="form-group mb-3 col-md-12">
                                                <label for="comments">Comments:</label>
                                                <textarea wire:model.live="comments" id="comments" class="form-control"></textarea>
                                                @error('comments')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row row">
                                        </div>
                                        <div class="form-row row">
                                            <div>
                                                <label for="accountNumber">Account Number:</label>
                                                <input type="text" wire:model.live="accountNumber" id="accountNumber"
                                                    class="form-control">
                                                @error('accountNumber')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button wire:click="$set('modalMode', '')" data-bs-dismiss="modal"
                                            class="btn btn-outline-danger">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Ajouter supplier</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- =======================END POP UP ADD USER ========================== --}}

                    {{-- ======================= POP UP Modify Fournisseur ========================== --}}

                    {{-- NEW MODAL --}}
                    {{-- BUTTON MODAL --}}
                    <div class="text-center">
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#myModal5">
                            Large Modal
                        </button> --}}
                    </div>


                    {{-- MODAL --}}
                    <div wire:ignore.self class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="contentModal">
                                    <form wire:submit.prevent="save">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Fournisseur</h4>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div div class="form-row row">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="firstName">First Name:</label>
                                                    <input type="text" wire:model="firstName" id="firstName"
                                                        placeholder="{{ $firstName }}" class="form-control">
                                                    @error('firstName')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="lastName">Last Name:</label>
                                                    <input type="text" wire:model="lastName" id="lastName"
                                                        class="form-control">
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
                                                    <input type="text" wire:model="companyName" id="companyName"
                                                        class="form-control">
                                                    @error('companyName')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="category">Category:</label>
                                                    <select wire:model="category" id="category"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="0">Male</option>
                                                        <option value="1">Female</option>
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
                                                    <input type="text" wire:model="agencyName" id="agencyName"
                                                        class="form-control">
                                                    @error('agencyName')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="email">Email:</label>
                                                    <input type="email" wire:model="email" id="email"
                                                        class="form-control">
                                                    @error('email')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="phoneNumber">Phone Number:</label>
                                                    <input type="text" wire:model="phoneNumber" id="phoneNumber"
                                                        class="form-control">
                                                    @error('phoneNumber')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group mb-3 col-md-12">
                                                    <label for="address_1">Address 1:</label>
                                                    <input type="text" wire:model="address_1" id="address1"
                                                        class="form-control">
                                                    @error('address1')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 col-md-12">
                                                    <label for="address_2">Address 2:</label>
                                                    <input type="text" wire:model="address_2" id="address2"
                                                        class="form-control">
                                                    @error('address2')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row row">
                                                <div class="form-group mb-3 col-md-4">
                                                    <label for="country">Country:</label>
                                                    <input type="text" wire:model="country" id="country"
                                                        class="form-control">
                                                    @error('country')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="city">City:</label>
                                                    <input type="text" wire:model="city" id="city"
                                                        class="form-control">
                                                    @error('city')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 col-md-3">
                                                    <label for="state">State:</label>
                                                    <input type="text" wire:model="state" id="state"
                                                        class="form-control">
                                                    @error('state')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3 col-md-2">
                                                    <label for="zip">Zip:</label>
                                                    <input type="text" wire:model="zip" id="zip"
                                                        class="form-control">
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
                                                    <input type="text" wire:model="accountNumber"
                                                        id="accountNumber" class="form-control">
                                                    @error('accountNumber')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Sauvegarder
                                                changements</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                wire:click="$set('modalMode', '')">Fermer</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- =======================END POP UP Modify Fournisseur ========================== --}}

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Identifier</th>
                                    <th>Nom d'agence</th>
                                    <th>Nom d'entreprise</th>
                                    <th>Catégorie</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Numéro téléphone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($suppliers != null)
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $supplier->id }}</td>
                                            <td>{{ $supplier->agency_name }}</td>
                                            <td>{{ $supplier->company_name }}</td>
                                            <td>{{ $supplier->category }}</td>
                                            <td>{{ $supplier->people->last_name }}</td>
                                            <td>{{ $supplier->people->first_name }}</td>
                                            <td>{{ $supplier->people->email }}</td>
                                            <td>{{ $supplier->people->phone_number }}</td>



                                            <td>
                                                <a href="{{ route('supplier.edit', $supplier->id) }}"
                                                    class="mr-2"><i
                                                        class="fa fa-edit text-primary font-18 dz-size1"></i></a>
                                                <a href="#"
                                                    wire:confirm='you are sure for deleting this cutomer'
                                                    wire:click="deleteSupplier({{ $supplier->id }})"><i
                                                        class="fa fa-trash text-danger font-18"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom d'agence</th>
                                        <th>Nom d'entreprise</th>
                                        <th>Catégorie</th>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Numéro téléphone</th>
                                        <th>Action</th>
                                        {{-- <th>E-mail</th> --}}
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        {{-- {{ $suppliersList->links() }} --}}

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div>
</div>
</div>