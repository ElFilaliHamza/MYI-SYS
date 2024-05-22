<div>

    <div>
        {{-- Full CARD --}}
        <div class="card">
            <div class="card-body">
                {{-- header of the card --}}
                <div class="conteneur">
                    <h1 class="card-title mb-2">depences categorie</h1>
                    <div class="conteneur-button">
                        <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                            data-bs-target="#AddModal" wire:model.live="search">
                            Ajouter depence categorie
                        </button>
                    </div>
                </div>
                {{-- search row  --}}
                <div class="row pb-2">
                    <div class="col-sm-12 col-md-8">
                        {{-- <p class="mb-30">Add class <code>.table-hover</code></p> --}}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control form-control-sm" placeholder="Rechercher depense categorie"
                            type="text" wire:model.live='search'>
                    </div>
                </div>

                {{-- Success message --}}
                <div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif (session()->has('successDelete'))
                        <div class="alert alert-danger">
                            {{ session('successDelete') }}
                        </div>
                    @endif
                </div>

                {{-- table of date --}}
                <div class="table-responsive">
                    <table class="table table-hover bg-white ">
                        <thead>
                            <tr>
                                <th>Groupes ID</th>
                                <th>Catégorie</th>
                                <th>Description de la catégorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories != null)
                                @foreach ($categories as $categorie)
                                    <tr>
                                        <td>{{ $categorie->id }}</td>
                                        <td>{{ $categorie->category_name }}</td>
                                        <td>{{ $categorie->category_description }}</td>

                                        <td>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#modifyModal"
                                                wire:click="edit('{{ $categorie->id }}')"class="mr-2"><i
                                                    class="fa fa-edit text-primary font-18"></i></a>
                                            <a href="#" wire:confirm='you are sure for deleting this cutomer'
                                                wire:click="delete({{ $categorie->id }})"><i
                                                    class="fa fa-trash text-danger font-18"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>There's no depenses yet</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $categoriesData->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Add Depense Modal --}}
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                {{-- FORM --}}
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="AddModalLabel"> Ajouter depense </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- Nom categorie --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="supplier_id">Nom categorie:</label>
                                <input class="form-control" type="text" wire:model="category_name"
                                    placeholder="Nom de la catégorie">
                                @error('category_name')
                                    <span>{{ $message }}</span>
                                @enderror
                                @error('supplier_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- descreption --}}
                        <div class="form-row row">
                            <div>
                                <label for="amount">Descreption de la categorie:</label>
                                <input class="form-control" type="text" wire:model="category_description"
                                    placeholder="Description de la catégorie">
                                @error('category_description')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add
                            changes</button>
                    </div>
                </form>
                {{-- END FORM --}}
            </div>
        </div>
    </div>


    {{-- Modify Depense Modal --}}
    @if ($selectedCategoryId)
        <div wire:ignore.self class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    {{-- FORM --}}
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modifyModalLabel"> Ajouter depense </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            {{-- Nom categorie --}}
                            <div class="form-row row">
                                <div class="form-group mb-3">
                                    <label for="supplier_id">Nom categorie:</label>
                                    <input type="text" wire:model="category_name" placeholder="Nom de la catégorie">
                                    @error('category_name')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    @error('supplier_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- descreption --}}
                            <div class="form-row row">
                                <div>
                                    <label for="amount">Descreption de la categorie:</label>
                                    <input type="text" wire:model="category_description"
                                        placeholder="Description de la catégorie">
                                    @error('category_description')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add
                                changes</button>
                        </div>
                    </form>
                    {{-- END FORM --}}
                </div>
            </div>
        </div>
    @endif
