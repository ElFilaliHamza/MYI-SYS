<div>
    {{-- Full CARD --}}
    <div class="card">
        <div class="card-body">
            {{-- header of the card --}}
            <div class="conteneur">
                <h1 class="card-title mb-2">Clients</h1>
                <div class="conteneur-button">
                    <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Ajouter kit des articles
                    </button>
                </div>
            </div>
            {{-- search row --}}
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <p class="mb-30">Add class <code>.table-hover</code></p>
                </div>
                <div class="col-sm-12 col-md-4">
                    {{-- <input class="form-control form-control-sm" placeholder="Rechercher client" type="text"
                        wire:model.live='search'> --}}
                </div>
            </div>
            {{-- table of date --}}
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Groupes ID</th>
                            <th>Code à barres</th>
                            <th>Nom du groupes</th>
                            <th>Description du groupes</th>
                            <th>Prix de gros</th>
                            <th>Prix de détail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($item_kits)
                            @foreach ($item_kits as $itemKit)
                                <tr>
                                    <td>{{ $itemKit->id }}</td>
                                    <td>{{ $itemKit->item_kit_number }}</td>
                                    <td>{{ $itemKit->name }}</td>
                                    <td>{{ $itemKit->description }}</td>
                                    <td>{{ $this->calculateRetailPrice($itemKit->id) }}</td>
                                    <td>{{ $this->calculateWholesalePrice($itemKit->id) }}</td>
                                    {{-- <td>
                                <button type="button" class="btn btn-outline-success"
                                    wire:click="edit({{ $itemKit->id }})">Modifier</button>
                                <button type="button" class="btn btn-outline-danger"
                                    wire:click="delete({{ $itemKit->id }})">Supprimer</button>


                            </td> --}}

                                    <td>
                                        <a wire:click="edit({{ $itemKit->id }})" data-bs-toggle="modal"
                                            data-bs-target="#EditModal" class="mr-2"><i
                                                class="fa fa-edit text-primary font-20 "></i></a>
                                                <a href="#" wire:confirm='you are sure for deleting this cutomer'
                                                wire:click="delete({{ $itemKit->id }})"><i
                                                class="fa fa-trash text-danger font-20"></i></a>
                                                <a wire:click="generateBarcode({{ $itemKit->id }})" class="mr-2 pl-2 ps-2"><i
                                                        class="fa fa-qrcode text-success font-20 dz-size1"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Aucune Article en kit trouvée.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div>
                    {{ $itemKitsData->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- ======================= POP UP Add USER ========================== --}}
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                {{-- FORM --}}
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Ajouter article en kit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="item_kit_number">Code à barres:</label>
                            <input class="form-control" type="number" wire:model="item_kit_number">
                            @error('item_kit_number')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="pt-2 " for="name">Nom du groupe:</label>
                            <input class="form-control" type="text" wire:model="name">
                            @error('name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="pt-2" for="kit_discount_type">Type de rabais:</label><br>
                        <div class="ps-2">
                            <input type="radio" name="kit_discount_type" wire:model="kit_discount_type"
                                value="Discount_percentage">
                            <label for="pourcentage">Pourcentage d'escompte</label><br>
                            <input type="radio" name="kit_discount_type" wire:model="kit_discount_type"
                                value="Fixed_discount">
                            <label for="rabais_fixe">Rabais fixe</label>
                            @error('kit_discount_type')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="kit_discount">Rabais:</label>
                            <input class="form-control" type="number" wire:model="kit_discount">
                            @error('kit_discount')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <label class="pt-2" for="price_option">Option de prix:</label><br>
                        <div class="ps-2">
                            <input type="radio" name="price_option" wire:model="price_option"
                                value="Groups_components">
                            <label for="pourcentage">Groupes et composants </label><br>
                            <input type="radio" name="price_option" wire:model="price_option" value="Group">
                            <label for="rabais_fixe">Group seulement</label><br>
                            <input type="radio" name="price_option" wire:model="price_option" value="Group_Stock">
                            <label for="rabais_fixe">Group Et Stock</label>
                            @error('price_option')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <label for="print_option">Type d'impression:</label><br>
                        <div class="ps-2">
                            <input type="radio" name="print_option" wire:model="print_option" value="all">
                            <label for="tous">Tous</label><br>
                            <input type="radio" name="print_option" wire:model="print_option" value="price">
                            <label for="prix_seulement">Prix seulement</label><br>
                            <input type="radio" name="print_option" wire:model="print_option" value="group">
                            <label for="group_seulement">Group seulement</label>
                            @error('print_option')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="description">Description:</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                            @error('description')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Section pour la sélection des articles -->
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div>
                            <label class="pt-2" for="article">Article:</label>
                            <select class="form-control" wire:model="item_id">
                                <option value="">Sélectionnez un article</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="p-2">
                            <button type="button" class="btn btn-dark" wire:click="addArticle">Ajouter un
                                article
                            </button>

                            @error('item_id')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Liste des articles sélectionnés -->
                        <div class="">
                            <label>Liste des articles sélectionnés:</label>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Article</th>
                                        <th>Quantité</th>
                                        <th>Séquence</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectedArticles)
                                        @foreach ($selectedArticles as $index => $selected)
                                            <tr>
                                                <td>{{ $selected['id'] }}</td>
                                                <td>{{ $selected['name'] }}</td>
                                                <td>
                                                    <input class="form-control" type="number"
                                                        wire:model="selectedArticles.{{ $index }}.quantity">
                                                    @error('selectedArticles.' . $index . '.quantity')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number"
                                                        wire:model="selectedArticles.{{ $index }}.kit_sequence">
                                                    @error('selectedArticles.' . $index . '.kit_sequence')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>Theres no items yet</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>

                        {{-- <div>
                            <button class="btn btn-outline-dark" type="submit" data-bs-dismiss="">Ajouter un article
                                en kit</button>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal" type="submit">Add
                            changes</button>
                    </div>
                </form>
                {{-- END FORM --}}
            </div>
        </div>
    </div>
    {{-- ======================= END POP UP Add USER ========================== --}}


    {{-- ======================= POP UP Modify USER ========================== --}}
    <div wire:ignore.self class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">



                @if ($selectitemkitId)
                    {{-- FORM --}}
                    <form wire:submit.prevent="update">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Ajouter article en kit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="item_kit_number">Code à barres:</label>
                                <input class="form-control" type="number" wire:model="item_kit_number">
                                @error('item_kit_number')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="pt-2 " for="name">Nom du groupe:</label>
                                <input class="form-control" type="text" wire:model="name">
                                @error('name')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <label class="pt-2" for="kit_discount_type">Type de rabais:</label><br>
                            <div class="ps-2">
                                <input type="radio" name="kit_discount_type" wire:model="kit_discount_type"
                                    value="Discount_percentage">
                                <label for="pourcentage">Pourcentage d'escompte</label><br>
                                <input type="radio" name="kit_discount_type" wire:model="kit_discount_type"
                                    value="Fixed_discount">
                                <label for="rabais_fixe">Rabais fixe</label>
                                @error('kit_discount_type')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="kit_discount">Rabais:</label>
                                <input class="form-control" type="number" wire:model="kit_discount">
                                @error('kit_discount')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <label class="pt-2" for="price_option">Option de prix:</label><br>
                            <div class="ps-2">
                                <input type="radio" name="price_option" wire:model="price_option"
                                    value="Groups_components">
                                <label for="pourcentage">Groupes et composants </label><br>
                                <input type="radio" name="price_option" wire:model="price_option" value="Group">
                                <label for="rabais_fixe">Group seulement</label><br>
                                <input type="radio" name="price_option" wire:model="price_option"
                                    value="Group_Stock">
                                <label for="rabais_fixe">Group Et Stock</label>
                                @error('price_option')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <label for="print_option">Type d'impression:</label><br>
                            <div class="ps-2">
                                <input type="radio" name="print_option" wire:model="print_option" value="all">
                                <label for="tous">Tous</label><br>
                                <input type="radio" name="print_option" wire:model="print_option" value="price">
                                <label for="prix_seulement">Prix seulement</label><br>
                                <input type="radio" name="print_option" wire:model="print_option" value="group">
                                <label for="group_seulement">Group seulement</label>
                                @error('print_option')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="description">Description:</label>
                                <textarea class="form-control" wire:model="description"></textarea>
                                @error('description')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Section pour la sélection des articles -->
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div>
                                <label class="pt-2" for="article">Article:</label>
                                <select class="form-control" wire:model="item_id">
                                    <option value="">Sélectionnez un article</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="p-2">
                                <button type="button" class="btn btn-dark" wire:click="addArticle">Ajouter un
                                    article
                                </button>

                                @error('item_id')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Liste des articles sélectionnés -->
                            <div class="">
                                <label>Liste des articles sélectionnés:</label>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Article</th>
                                            <th>Quantité</th>
                                            <th>Séquence</th>
                                            <th>Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($selectedArticles)
                                            @foreach ($selectedArticles as $index => $selected)
                                                <tr>
                                                    <td>{{ $selected['id'] }}</td>
                                                    <td>{{ $selected['name'] }}</td>
                                                    <td>
                                                        <input type="number"
                                                            wire:model="selectedArticles.{{ $index }}.quantity">
                                                        @error('selectedArticles.' . $index . '.quantity')
                                                            <span>{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            wire:model="selectedArticles.{{ $index }}.kit_sequence">
                                                        @error('selectedArticles.' . $index . '.kit_sequence')
                                                            <span>{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>Theres no items yet</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            {{-- <div>
                            <button class="btn btn-outline-dark" type="submit" data-bs-dismiss="">Ajouter un article
                                en kit</button>
                        </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                type="submit">Modify
                                changes</button>
                        </div>
                    </form>
                    {{-- END FORM --}}
                @endif
            </div>
        </div>
    </div>
    {{-- ======================= END POP UP Modify USER ========================== --}}
