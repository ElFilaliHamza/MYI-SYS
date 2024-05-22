<div>
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="row">
                    <div class="col-12 box-margin height-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="wizard-form-area">

                                    <h5 class="card-title">Ajouter Employee</h5>
                                    <form wire:submit.prevent="createUser" id="example-form" action="#"
                                        method="post">
                                        <div>
                                            <h3>Account</h3>
                                            <section style="max-height: 450px; overflow-y: auto;">
                                                <h3>Account</h3>

                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input class="form-control" wire:model.defer="firstName"
                                                        id="first_name" type="text" name="first_name" required
                                                        autofocus>
                                                </div>

                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input class="form-control" wire:model.defer="lastName"
                                                        id="last_name" type="text" name="last_name" required>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="gender">Gender</label>
                                                    <select style="background-color: rgba(225, 225, 225, 0.565)"
                                                        class="form-control dropdown-toggle"  wire:model.defer="gender" id="gender"
                                                        name="gender" required>
                                                        <option value="1">Male</option>
                                                        <option value="0">Female</option>
                                                    </select>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input class="form-control" wire:model.defer="phoneNumber"
                                                        id="phone_number" type="text" name="phone_number" required>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="address_1">Address Line 1</label>
                                                    <input class="form-control" wire:model.defer="address1"
                                                        id="address_1" type="text" name="address_1" required>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="address_2">Address Line 2</label>
                                                    <input class="form-control" wire:model.defer="address2"
                                                        id="address_2" type="text" name="address_2">
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="city">City</label>
                                                    <input class="form-control" wire:model.defer="city" id="city"
                                                        type="text" name="city" required>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="zip">ZIP Code</label>
                                                    <input class="form-control" wire:model.defer="zip" id="zip"
                                                        type="text" name="zip" required>
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="comments">Comments</label>
                                                    <input class="form-control" wire:model.defer="comments"
                                                        id="comments" type="text" name="comments">
                                                </div>

                                                <div class="form-group pt-2">
                                                    <label for="country">Country</label>
                                                    <input class="form-control" wire:model.defer="country"
                                                        id="country" type="text" name="country" required>
                                                </div>
                                            </section>

                                            <h3>Profile</h3>
                                            <section style="max-height: 450px; overflow-y: auto;">
                                                <h3>Profile</h3>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input class="form-control" wire:model.defer="email" id="email"
                                                        type="email" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input class="form-control" wire:model.defer="password"
                                                        id="password" type="password" name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input class="form-control"
                                                        wire:model.defer="password_confirmation"
                                                        id="password_confirmation" type="password"
                                                        name="password_confirmation" required>
                                                </div>
                                            </section>

                                            <h3>Permissions</h3>
                                            <section style="max-height: 450px; overflow-y: auto;">
                                                <h3>Permissions</h3>
                                                <div class="container mt-4">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Category</th>
                                                                <th>Create</th>
                                                                <th>Delete</th>
                                                                <th>Update</th>
                                                                <th>Read</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach (['Client', 'Articles', 'Articles en kits', 'Fournisseurs', 'Employés', 'Dépenses', 'Dépensescatégorie', 'Encaissements'] as $category)
                                                                <div class="form-group">
                                                                    <tr>
                                                                        <td>{{ $category }}</td>
                                                                        <td>
                                                                            <div class="checkbox d-inline">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="create {{ $category }}"
                                                                                    {{--
                                                                                class="form-check-input" --}}
                                                                                    id="createCheckbox{{ $category }}"
                                                                                    wire:model.defer="permissions">
                                                                                <label class="cr"
                                                                                    for="createCheckbox{{ $category }}">Create</label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="checkbox d-inline">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="delete {{ $category }}"
                                                                                    {{--
                                                                                    class="form-check-input" --}}
                                                                                    id="deleteCheckbox{{ $category }}"
                                                                                    wire:model.defer="permissions">
                                                                                <label class="cr"
                                                                                    for="deleteCheckbox{{ $category }}">Delete</label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="checkbox d-inline">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="update {{ $category }}"
                                                                                    {{--
                                                                                class="form-check-input" --}}
                                                                                    id="updateCheckbox{{ $category }}"
                                                                                    wire:model.defer="permissions">
                                                                                <label class="cr"
                                                                                    for="updateCheckbox{{ $category }}">Update</label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="checkbox d-inline">
                                                                                <input type="checkbox"
                                                                                    name="permissions[]"
                                                                                    value="read {{ $category }}"
                                                                                    {{--
                                                                                class="form-check-input" --}}
                                                                                    id="readCheckbox{{ $category }}"
                                                                                    wire:model.defer="permissions">
                                                                                <label class="cr"
                                                                                    for="readCheckbox{{ $category }}">Read</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <div class="conteneur">
                                                        <div>
                                                            <h6>Vente</h6>
                                                            @foreach ($locations as $location)
                                                                <div class="form-group ps-5">
                                                                    <div class="checkbox d-inline">
                                                                        <input type="checkbox" name="venteLocations[]"
                                                                            id="{{ 'vente_' . $location->location_name }}"
                                                                            wire:model.defer="venteLocations"
                                                                            value="{{ 'vente_' . $location->id }}"">
                                                                        <label
                                                                            for="{{ 'vente_' . $location->location_name }}"
                                                                            class="cr">{{ $location->location_name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div>
                                                            <h6>Entree Stock :</h6>
                                                            @foreach ($locations as $location)
                                                                <div class="form-group ps-5">
                                                                    <div class="checkbox d-inline">
                                                                        <input type="checkbox"
                                                                            name="entreeStockLocations[]"
                                                                            id="{{ 'entreeStock_' . $location->location_name }}"
                                                                            wire:model.defer="venteLocations"
                                                                            value="{{ 'entreeStock_' . $location->id }}">
                                                                        <label
                                                                            for="{{ 'entreeStock_' . $location->location_name }}"
                                                                            class="cr">{{ $location->location_name }}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </div>
                                            </section>

                                            <h3>Finish</h3>
                                            <section style="max-height: 450px; overflow-y: auto;">
                                                <h3>Finish</h3>
                                                <div class="form-check">
                                                    <button class="btn btn-outline-success" type="submit"
                                                        data-bs-dismiss="modal">Create User</button>
                                                    <button class="btn btn-outline-danger"
                                                        wire:click="$set('modalMode', '')">Cancel</button>
                                                </div>
                                            </section>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($selectedUserId)
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-12 box-margin height-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="wizard-form-area">

                                        <h5 class="card-title">Ajouter Employee</h5>
                                        <form wire:submit.prevent="createUser" id="example-form" action="#"
                                            method="post">
                                            <div>
                                                <h3>Account</h3>
                                                <section style="max-height: 450px; overflow-y: auto;">
                                                    <h3>Account</h3>

                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input class="form-control" wire:model.defer="firstName"
                                                            id="first_name" type="text" name="first_name" required
                                                            autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input class="form-control" wire:model.defer="lastName"
                                                            id="last_name" type="text" name="last_name" required>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="gender">Gender</label>
                                                        <select style="background-color: rgba(225, 225, 225, 0.565)"
                                                            class="form-control" wire:model.defer="gender"
                                                            id="gender" name="gender" required>
                                                            <option value="1">Male</option>
                                                            <option value="0">Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="phone_number">Phone Number</label>
                                                        <input class="form-control" wire:model.defer="phoneNumber"
                                                            id="phone_number" type="text" name="phone_number"
                                                            required>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="address_1">Address Line 1</label>
                                                        <input class="form-control" wire:model.defer="address1"
                                                            id="address_1" type="text" name="address_1" required>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="address_2">Address Line 2</label>
                                                        <input class="form-control" wire:model.defer="address2"
                                                            id="address_2" type="text" name="address_2">
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="city">City</label>
                                                        <input class="form-control" wire:model.defer="city"
                                                            id="city" type="text" name="city" required>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="zip">ZIP Code</label>
                                                        <input class="form-control" wire:model.defer="zip"
                                                            id="zip" type="text" name="zip" required>
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="comments">Comments</label>
                                                        <input class="form-control" wire:model.defer="comments"
                                                            id="comments" type="text" name="comments">
                                                    </div>

                                                    <div class="form-group pt-2">
                                                        <label for="country">Country</label>
                                                        <input class="form-control" wire:model.defer="country"
                                                            id="country" type="text" name="country" required>
                                                    </div>
                                                </section>

                                                <h3>Profile</h3>
                                                <section style="max-height: 450px; overflow-y: auto;">
                                                    <h3>Profile</h3>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input class="form-control" wire:model.defer="email"
                                                            id="email" type="email" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input class="form-control" wire:model.defer="password"
                                                            id="password" type="password" name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input class="form-control"
                                                            wire:model.defer="password_confirmation"
                                                            id="password_confirmation" type="password"
                                                            name="password_confirmation" required>
                                                    </div>
                                                </section>

                                                <h3>Permissions</h3>
                                                <section style="max-height: 450px; overflow-y: auto;">
                                                    <h3>Permissions</h3>
                                                    <div class="container mt-4">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Category</th>
                                                                    <th>Create</th>
                                                                    <th>Delete</th>
                                                                    <th>Update</th>
                                                                    <th>Read</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach (['Client', 'Articles', 'Articles en kits', 'Fournisseurs', 'Employés', 'Dépenses', 'Dépensescatégorie', 'Encaissements'] as $category)
                                                                    <div class="form-group">
                                                                        <tr>
                                                                            <td>{{ $category }}</td>
                                                                            <td>
                                                                                <div class="checkbox d-inline">
                                                                                    <input type="checkbox"
                                                                                        name="permissions[]"
                                                                                        value="create {{ $category }}"
                                                                                        {{--
                                                                            class="form-check-input" --}}
                                                                                        id="createCheckbox{{ $category }}"
                                                                                        wire:model.defer="permissions">
                                                                                    <label class="cr"
                                                                                        for="createCheckbox{{ $category }}">Create</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox d-inline">
                                                                                    <input type="checkbox"
                                                                                        name="permissions[]"
                                                                                        value="delete {{ $category }}"
                                                                                        {{--
                                                                                class="form-check-input" --}}
                                                                                        id="deleteCheckbox{{ $category }}"
                                                                                        wire:model.defer="permissions">
                                                                                    <label class="cr"
                                                                                        for="deleteCheckbox{{ $category }}">Delete</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox d-inline">
                                                                                    <input type="checkbox"
                                                                                        name="permissions[]"
                                                                                        value="update {{ $category }}"
                                                                                        {{--
                                                                            class="form-check-input" --}}
                                                                                        id="updateCheckbox{{ $category }}"
                                                                                        wire:model.defer="permissions">
                                                                                    <label class="cr"
                                                                                        for="updateCheckbox{{ $category }}">Update</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox d-inline">
                                                                                    <input type="checkbox"
                                                                                        name="permissions[]"
                                                                                        value="read {{ $category }}"
                                                                                        {{--
                                                                            class="form-check-input" --}}
                                                                                        id="readCheckbox{{ $category }}"
                                                                                        wire:model.defer="permissions">
                                                                                    <label class="cr"
                                                                                        for="readCheckbox{{ $category }}">Read</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </div>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <div class="conteneur">
                                                            <div>
                                                                <h6>Vente</h6>
                                                                @foreach ($locations as $location)
                                                                    <div class="form-group ps-5">
                                                                        <div class="checkbox d-inline">
                                                                            <input type="checkbox"
                                                                                name="venteLocations[]"
                                                                                id="{{ 'vente_' . $location->location_name }}"
                                                                                wire:model.defer="venteLocations"
                                                                                value="{{ 'vente_' . $location->id }}"">
                                                                            <label
                                                                                for="{{ 'vente_' . $location->location_name }}"
                                                                                class="cr">{{ $location->location_name }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <div>
                                                                <h6>Entree Stock :</h6>
                                                                @foreach ($locations as $location)
                                                                    <div class="form-group ps-5">
                                                                        <div class="checkbox d-inline">
                                                                            <input type="checkbox"
                                                                                name="entreeStockLocations[]"
                                                                                id="{{ 'entreeStock_' . $location->location_name }}"
                                                                                wire:model.defer="venteLocations"
                                                                                value="{{ 'entreeStock_' . $location->id }}">
                                                                            <label
                                                                                for="{{ 'entreeStock_' . $location->location_name }}"
                                                                                class="cr">{{ $location->location_name }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>

                                                <h3>Finish</h3>
                                                <section style="max-height: 450px; overflow-y: auto;">
                                                    <h3>Finish</h3>
                                                    <div class="form-check">
                                                        <button class="btn btn-outline-success" type="submit"
                                                            data-bs-dismiss="modal">Create User</button>
                                                        <button class="btn btn-outline-danger"
                                                            wire:click="$set('modalMode', '')">Cancel</button>
                                                    </div>
                                                </section>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row conteneur">
                <div class="col-6">
                    <h1 class="card-title mb-2">Employés</h1>
                </div>
                {{-- <div class=" col-4">
                    <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher employee">
                </div> --}}
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" wire:model.live="search">
                        Ajouter 
                    </button>
                </div>
                {{-- <div class="conteneur-button">
                </div> --}}
            </div>
            <div class="conteneur pb-2 pt-2">
                <div class="col-8">
                    <p>Employé connecté : <code> {{ $authenticatedUserName }} </code></p>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" wire:model.live='search' placeholder="Rechercher employee">
                </div>
                {{-- <search /> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom de famille</th>
                            <th>Prénom</th>
                            <th>Courriel</th>
                            <th>Numéro de téléphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->people->first_name }}</td>
                                <td>{{ $user->people->email }}</td>
                                <td>{{ $user->people->phone_number }}</td>
                                {{-- <td>
                                <button data-bs-toggle="modal" data-bs-target="#exampleModalEdit"
                                    class="btn btn-outline-success"
                                    wire:click="editUser({{ $user->id }})">Modifier</button>
                                <button class="btn btn-outline-danger"
                                    wire:click="deleteUser({{ $user->id }}, $event)">Supprimer</button>
                            </td> --}}
                                <td>
                                    <a wire:click="editUser({{ $user->id }})" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalEdit" class="mr-2"><i
                                            class="fa fa-edit text-primary font-18 dz-size1"></i></a>
                                    <a wire:confirm='you are sure for deleting this cutomer'
                                        wire:click="deleteUser({{ $user->id }}, $event)"><i
                                            class="fa fa-trash text-danger font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employeesData->links() }}
            </div>
        </div>
    </div>
</div>
{{-- {{ $employeesData->links() }} --}}
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
