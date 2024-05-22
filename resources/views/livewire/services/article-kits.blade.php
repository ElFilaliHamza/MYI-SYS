<div>
    <input type="text" wire:model.live="search" placeholder="Rechercher...">
{{-- @if($selectitemkitId) --}}
    <form wire:submit.prevent="store">
        <div>
            <label for="item_kit_number">Code à barres:</label>
            <input type="number" wire:model="item_kit_number">
            @error('item_kit_number') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="name">Nom du groupe:</label>
            <input type="text" wire:model="name">
            @error('name') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="kit_discount_type">Type de rabais:</label><br>
            <input type="radio" name="kit_discount_type" wire:model="kit_discount_type" value="Discount_percentage" >
            <label for="pourcentage">Pourcentage d'escompte</label><br>
            <input type="radio" name="kit_discount_type" wire:model="kit_discount_type" value="Fixed_discount">
            <label for="rabais_fixe">Rabais fixe</label>
            @error('kit_discount_type') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="kit_discount">Rabais:</label>
            <input type="number" wire:model="kit_discount">
            @error('kit_discount') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="price_option">Option de prix:</label><br>
            <input type="radio" name="price_option" wire:model="price_option" value="Groups_components" >
            <label for="pourcentage">Groupes et composants </label><br>
            <input type="radio" name="price_option" wire:model="price_option" value="Group">
            <label for="rabais_fixe">Group seulement</label><br>
            <input type="radio" name="price_option" wire:model="price_option" value="Group_Stock">
            <label for="rabais_fixe">Group Et Stock</label>
            @error('price_option') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="print_option">Type d'impression:</label><br>
            <input type="radio" name="print_option" wire:model="print_option" value="all">
            <label for="tous">Tous</label><br>
            <input type="radio" name="print_option" wire:model="print_option" value="price">
            <label for="prix_seulement">Prix seulement</label><br>
            <input type="radio" name="print_option" wire:model="print_option" value="group">
            <label for="group_seulement">Group seulement</label>
            @error('print_option') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea wire:model="description"></textarea>
            @error('description') <span>{{ $message }}</span> @enderror
        </div>
        <!-- Section pour la sélection des articles -->
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div>
            <label for="article">Article:</label>
            <select wire:model="item_id">
                <option value="">Sélectionnez un article</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            
            <button type="button" class="btn btn-dark" wire:click="addArticle">Ajouter un article</button>
            @error('item_id') <span>{{ $message }}</span> @enderror
        </div>
        <!-- Liste des articles sélectionnés -->
        <div>
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
                @foreach($selectedArticles as $index => $selected)
                <tr>
                    <td>{{ $selected['id'] }}</td>
                    <td>{{ $selected['name'] }}</td>
                    <td>
                        <input type="number" wire:model="selectedArticles.{{ $index }}.quantity">
                        @error('selectedArticles.'.$index.'.quantity') <span>{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="number" wire:model="selectedArticles.{{ $index }}.kit_sequence">
                        @error('selectedArticles.'.$index.'.kit_sequence') <span>{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger" wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    
        <div>
            <button class="btn btn-outline-dark" type="submit">Modifier un article en kit</button>
        </div>
    </form>
{{-- @endif --}}

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
            @if($item_kits)
                @foreach($item_kits as $itemKit)
                    <tr>
                        <td>{{ $itemKit->id }}</td>
                        <td>{{ $itemKit->item_kit_number }}</td>
                        <td>{{ $itemKit->name }}</td>
                        <td>{{ $itemKit->description }}</td>
                        <td>{{ $this->calculateRetailPrice($itemKit->id) }}</td>
                        <td>{{ $this->calculateWholesalePrice($itemKit->id) }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-success"  wire:click="edit({{ $itemKit->id }})">Modifier</button>
                            <button type="button" class="btn btn-outline-danger" wire:click="delete({{ $itemKit->id }})">Supprimer</button>
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
        {{$item_kitss->links()}}
    </div>
</div>

