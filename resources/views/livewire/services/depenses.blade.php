<div>
    <input type="text" wire:model.live="search">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@if($selectedExpenseId)
    <form wire:submit.prevent="update">
        <div>
            <label for="supplier_id">Fournisseur:</label>
            <select wire:model="supplier_id" id="supplier_id">
                <option value="">Select Supplier</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->people->first_name }} {{ $supplier->people->last_name }}</option>
                @endforeach
            </select>
            @error('supplier_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
        <label for="amount">Montant:</label>
        <input type="text" wire:model="amount" id="amount">
        @error('amount') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div>
        <label for="payment_type">Payment Type:</label>
        <select wire:model="payment_type" id="payment_type">
            <option value="espece">Espèces</option>
            <option value="cheque">Chèque</option>
            <option value="carte_de_debit">Carte de débit</option>
            <option value="carte_de_credit">Carte de crédit</option>
        </select>
        @error('payment_type') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="expense_category_id">Catégorie:</label>
        <select wire:model="expense_category_id" id="expense_category_id">
            @foreach($expenseCategories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        </select>
        @error('expense_category_id') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="user_id">Créé par:</label>
        <select wire:model="user_id" id="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->people->first_name }} {{ $user->people->last_name }}</option>
            @endforeach
        </select>
        @error('user_id') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="date">Date:</label>
        <input type="date" wire:model="date" id="date">
        @error('date') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea wire:model="description" id="description"></textarea>
        @error('description') <span class="error">{{ $message }}</span> @enderror
    </div>


        <button type="submit">Create Expense</button>
    </form>
@endif
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Fournisseur</th>
                    <th>Montant</th>
                    <th>Type de paiement</th>
                    <th>Catégorie</th>
                    <th>Description</th>
                    <th>Créé par</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->supplier->people->first_name }} {{ $expense->supplier->people->last_name }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->payment_type }}</td>
                        <td>{{ $expense->expenseCategory->category_name }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->user->people->first_name }} {{ $expense->user->people->last_name }}</td>
                        <td>
                        <button type="button" class="btn btn-outline-success"  wire:click="edit('{{ $expense->id }}')">Modifier</button>
                        <button type="button" class="btn btn-outline-danger" wire:click="delete({{ $expense->id }})">Supprimer</button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$expenses->links()}}
    </div>
</div>
