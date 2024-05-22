<div>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div>
            <label for="name">Nom:</label>
            <input type="text" wire:model="name" wire:change="validateField('name')">
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="category">Catégorie:</label>
            <input type="text" wire:model="category">
            @error('category')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="item_number">Numéro d'article:</label>
            <input type="number" wire:model="item_number">
            @error('item_number')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea wire:model="description" wire:change="validateField('description')"></textarea>
            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="cost_price">Prix d'achat:</label>
            <input type="number" wire:model="cost_price">
            @error('cost_price')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="unit_price">Prix unitaire:</label>
            <input type="number" wire:model="unit_price">
            @error('unit_price')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="pic_filename">l' image:</label>
            <input type="file" wire:model="pic_filename">
            @error('pic_filename')
                <span>{{ $message }}</span>
            @enderror
            @if ($pic_filename)
                <p>Type de champ de l'image: {{ gettype($pic_filename) }}</p>
            @endif

        </div>


        <div>
            <label for="item_type">Type d'article:</label>
            <input type="radio" wire:model="item_type" value="1"> Régulier
            <input type="radio" wire:model="item_type" value="0"> Ensemble
            @error('item_type')
                <span>{{ $message }}</span>
            @enderror
        </div>


        <button type="submit">Enregistrer l'article</button>
    </form>
    <div>


        <table >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Numéro d'article</th>
                    <th>Deleted</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->item_number }}</td>
                        <td>{{ $item->deleted }}</td>

                        <td>
                            <button class="btn btn-outline-success" wire:click="edit('{{ $item->id }}')">Modifier</button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger" wire:click="destroy({{ $item->id }})">Supprimer</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
