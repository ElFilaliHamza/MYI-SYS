<div>
<input type="text" wire:model.live="search" placeholder="Rechercher...">
@if($selectedCategoryId)
<div> @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-dnager">
        {{ session('error') }}
    </div>
    @endif
    <input type="text" wire:model="category_name" placeholder="Nom de la catégorie">
    @error('category_name') <span>{{ $message }}</span> @enderror

    <input type="text" wire:model="category_description" placeholder="Description de la catégorie">
    @error('category_description') <span>{{ $message }}</span> @enderror

    <button wire:click="update">Créer une catégorie</button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Groupes ID</th>
                <th>Catégorie</th>
                <th>Description de la catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    @foreach($categories as $categorie)
    <tr>
        <td>{{ $categorie->id }}</td>
        <td>{{ $categorie->category_name }}</td>
        <td>{{ $categorie->category_description }}</td>
        <td>
            <button type="button" class="btn btn-outline-success"  wire:click="edit('{{ $categorie->id }}')">EditModifier</button>
            <button type="button" class="btn btn-outline-danger" wire:click="delete({{ $categorie->id }})">Supprimer</button>

        </td>
    </tr>
    @endforeach
</tbody>
</table>
    {{$categoriess->links()}}
</div>
</div>

