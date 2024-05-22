<div>
    <div class="card">
        <div class="card-body">
            <div class="conteneur">
                <h1 class="card-title mb-2">Articles</h1>
                <div class="conteneur-button">
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                            data-bs-target="#modalCreate" wire:model.live="search">
                            Ajouter article
                        </button>
                    </div>

                </div>
            </div>
            {{-- search row  --}}
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    {{-- <p class="mb-30">Add class <code>.table-hover</code></p> --}}
                </div>
                <div class="col-sm-12 col-md-4">
                    <input class="form-control form-control-sm" placeholder="Rechercher client" type="text"
                        wire:model.live='search'>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Numéro d'article</th>
                            <th>Prix de gros</th>
                            <th>Prix de détail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($items != null)
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->item_number }}</td>
                                    <td>{{ $item->cost_price }} MAD</td>
                                    <td>{{ $item->unit_price }} MAD</td>

                                    <td>
                                        {{-- <a href="{{ route('article.edit', $item->id) }}" class="mr-2"><i
                                                class="fa fa-edit text-primary font-18 dz-size1"></i></a> --}}
                                        <a wire:click="edit('{{ $item->id }}')" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit" class="mr-2"><i
                                                class="fa fa-edit text-primary font-18 dz-size1"></i></a>
                                        <a href="#" wire:confirm='you are sure for deleting this cutomer'
                                            wire:click="destroy({{ $item->id }})"><i
                                                class="fa fa-trash text-danger font-18"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>There's no data</td>

                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- {{ $ArticlesList->links() }} --}}
            </div>
            {{-- {{ $itemsList->links() }} --}}
        </div>
    </div>

    <!-- Modal -->


    {{-- ======================= POP UP Add ARTICLE ========================== --}}
    <div wire:ignore.self class="modal inmodal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="contentModal">
                    {{-- FORM --}}
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter article</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="pt-1">
                                <label for="name">Nom:</label>
                                <input class="form-control" type="text" wire:model.live="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="category">Catégorie:</label>
                                <input class="form-control" type="text" wire:model.blur="category">
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="stock_type">Type d'inventaire:</label>
                                <br>
                                <div class="pl-3">
                                    <input class="form-check-input" type="radio" name="stock_type"
                                        id="inventaireCheck" wire:model.blur="stock_type" value="inventaire">
                                    <label for="inventaireCheck">Inventaire</label>
                                    <input class="form-check-input" type="radio" name="stock_type"
                                        id="Non-inventorieCheck" wire:model.blur="stock_type" value="non-inventorie">
                                    <label for="Non-inventorieCheck">Non-inventorié</label>
                                </div>
                                @error('stock_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="item_number">Numéro d'article:</label>
                                <input class="form-control" type="number" wire:model.blur="item_number">
                                @error('item_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="item_type">Type d'article : </label>
                                <br>
                                <div class="pl-3">
                                    <input class="form-check-input" type="radio" id="regulierCheck"
                                        name="typeArticleCheck" wire:model.blur="item_type" value="1">
                                    <label for="regulierCheck">Régulier</label>
                                    <input class="form-check-input" type="radio" id="ensembleCheck"
                                        name="typeArticleCheck" wire:model.blur="item_type" value="0">
                                    <label for="ensembleCheck">Ensemble</label>
                                </div>
                                @error('item_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="description">Description:</label>
                                <textarea class="form-control" wire:model.blur="description"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="cost_price">Prix d'achat:</label>
                                <input class="form-control" type="number" wire:model.blur="cost_price">
                                @error('cost_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="unit_price">Prix unitaire:</label>
                                <input class="form-control" type="number" wire:model.blur="unit_price">
                                @error('unit_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="pt-1">
                                <label for="pic_filename">l' image:</label>
                                <input class="form-control" type="file" wire:model.blur="pic_filename"
                                    accept="image/*">
                                @error('pic_filename')
                                    <span>{{ $message }}</span>
                                @enderror
                                @if ($pic_filename)
                                    <p>Type de champ de l'image: {{ gettype($pic_filename) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save
                                changes</button>
                        </div>
                    </form>
                    {{-- END FORM --}}
                </div>
            </div>
        </div>
    </div>
    {{-- ======================= END POP UP Add Article ========================== --}}

    {{-- ======================= POP UP Edit ARTICLE ========================== --}}
    <div wire:ignore.self class="modal inmodal fade" id="modalEdit" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="contentModal">

                    @if ($selectedItemId)
                        {{-- FORM --}}
                        <form wire:submit.prevent="updateArticle" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter article</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="pt-1">
                                    <label for="name">Nom:</label>
                                    <input class="form-control" type="text" wire:model.live="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="category">Catégorie:</label>
                                    <input class="form-control" type="text" wire:model.blur="category">
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="stock_type">Type d'inventaire:</label>
                                    <br>
                                    <div class="pl-3">
                                        <input class="form-check-input" type="radio" name="stock_type"
                                            id="inventaireCheck" wire:model.blur="stock_type" value="inventaire">
                                        <label for="inventaireCheck">Inventaire</label>
                                        <input class="form-check-input" type="radio" name="stock_type"
                                            id="Non-inventorieCheck" wire:model.blur="stock_type"
                                            value="non-inventorie">
                                        <label for="Non-inventorieCheck">Non-inventorié</label>
                                    </div>
                                    @error('stock_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="item_number">Numéro d'article:</label>
                                    <input class="form-control" type="number" wire:model.blur="item_number">
                                    @error('item_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="item_type">Type d'article : </label>
                                    <br>
                                    <div class="pl-3">
                                        <input class="form-check-input" type="radio" id="regulierCheck"
                                            name="typeArticleCheck" wire:model.blur="item_type" value="1">
                                        <label for="regulierCheck">Régulier</label>
                                        <input class="form-check-input" type="radio" id="ensembleCheck"
                                            name="typeArticleCheck" wire:model.blur="item_type" value="0">
                                        <label for="ensembleCheck">Ensemble</label>
                                    </div>
                                    @error('item_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" wire:model.blur="description"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="cost_price">Prix d'achat:</label>
                                    <input class="form-control" type="number" wire:model.blur="cost_price">
                                    @error('cost_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="unit_price">Prix unitaire:</label>
                                    <input class="form-control" type="number" wire:model.blur="unit_price">
                                    @error('unit_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="pt-1">
                                    <label for="pic_filename">l' image:</label>
                                    <input class="form-control" type="file" wire:model.blur="pic_filename"
                                        accept="image/*">
                                    @error('pic_filename')
                                        <span>{{ $message }}</span>
                                    @enderror
                                    @if ($pic_filename)
                                        <p>Type de champ de l'image: {{ gettype($pic_filename) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save
                                    changes</button>
                            </div>
                        </form>
                        {{-- END FORM --}}
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ======================= END POP UP Edit Article ========================== --}}

</div>
</div>
