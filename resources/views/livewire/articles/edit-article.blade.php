<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="contentModal">
        {{-- FORM --}}
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Ajouter article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div>
                <label for="name">Nom:</label>
                <input class="form-control" type="text" wire:model="name">
                @error('name')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="category">Catégorie:</label>
                <input class="form-control" type="text" wire:model="category">
                @error('category')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="item_number">Numéro d'article:</label>
                <input class="form-control" type="number" wire:model="item_number">
                @error('item_number')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <label for="item_type">Type d'article:</label>
            <div class="form-control">
                <input class="" type="radio" wire:model="item_type" value="1" name="item_type"> Régulier
                <input class="" type="radio" wire:model="item_type" value="0" name="item_type"> Ensemble
                @error('item_type')
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
            <div>
                <label for="cost_price">Prix d'achat:</label>
                <input class="form-control" type="number" wire:model="cost_price">
                @error('cost_price')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="unit_price">Prix unitaire:</label>
                <input class="form-control" type="number" wire:model="unit_price">
                @error('unit_price')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="pic_filename">l' image:</label>
                <input class="form-control" type="file" wire:model="pic_filename">
                @error('pic_filename')
                    <span>{{ $message }}</span>
                @enderror
                @if ($pic_filename)
                    <p>Type de champ de l'image: {{ gettype($pic_filename) }}</p>
                @endif

            </div>
            {{-- <button type="submit">Enregistrer l'article</button> --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
            </div>
        </form>
        {{-- END FORM --}}
    </div>
</div>
