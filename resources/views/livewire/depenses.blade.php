<div>
    {{-- Full CARD --}}
    <div class="card">
        <div class="card-body">
            {{-- header of the card --}}
            <div class="conteneur">
                <h1 class="card-title mb-2">Dépenses</h1>
                <div class="conteneur-button">
                    <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                        data-bs-target="#AddModal" wire:model.live="search">
                        Ajouter dépense
                    </button>
                </div>
            </div>
            {{-- search row  --}}
            <div class="row pb-2">
                <div class="col-sm-12 col-md-8">
                    {{-- <p class="mb-30">Add class <code>.table-hover</code></p> --}}
                </div>
                <div class="col-sm-12 col-md-4">
                    <input class="form-control form-control-sm" placeholder="Rechercher client" type="text"
                        wire:model.live='search'>
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
                        @if ($expenses != null)
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->id }}</td>
                                    <td>{{ $expense->date }}</td>
                                    <td>{{ $expense->supplier->people->first_name }}
                                        {{ $expense->supplier->people->last_name }}
                                    </td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->payment_type }}</td>
                                    <td>{{ $expense->expenseCategory->category_name }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->user->people->first_name }}
                                        {{ $expense->user->people->last_name }}</td>

                                    <td>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modifyModal"
                                            wire:click="edit('{{ $expense->id }}')"class="mr-2"><i
                                                class="fa fa-edit text-primary font-18"></i></a>
                                        <a href="#" wire:confirm='you are sure for deleting this cutomer'
                                            wire:click="delete({{ $expense->id }})"><i
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
                {{ $expenseslist->links() }}
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

                        {{-- fournisseur --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="supplier_id">Fournisseur:</label>
                                <select class="form-control" wire:model="supplier_id" id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->people->first_name }}
                                            {{ $supplier->people->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Montant, paymentType --}}
                        <div class="form-row row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="amount">Montant:</label>
                                <input class="form-control" type="text" wire:model="amount" id="amount">
                                @error('amount')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="payment_type">Payment Type:</label>
                                <select class="form-control" wire:model="payment_type" id="payment_type">
                                    <option value=""></option>
                                    <option value="espece">Espèces</option>
                                    <option value="cheque">Chèque</option>
                                    <option value="carte_de_debit">Carte de débit</option>
                                    <option value="carte_de_credit">Carte de crédit</option>
                                </select>
                                @error('payment_type')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- categorie --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="expense_category_id">Catégorie:</label>
                                <select class="form-control" wire:model="expense_category_id" id="expense_category_id">
                                    <option value=""></option>
                                    @foreach ($expenseCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('expense_category_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- cree par --}}
                        <div class="form-row row">
                            <div class="form-group mb-3">
                                <label for="user_id">Créé par:</label>
                                <select class="form-control" wire:model="user_id" id="user_id">
                                    <option value=""></option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->people->first_name }}
                                            {{ $user->people->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- date --}}
                        <div class="form-row row">
                            <div class="form-group mb-3 ">
                                <label for="date">Date:</label>
                                <div class="input-group clockpicker" data-placement="top" data-align="top"
                                    data-autoclose="true">
                                    <input style="background-color: #f3f6f7" class="form-control bg-gray-100"
                                        class="form-control" type="datetime" value="{{ now() }}"
                                        id="date" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-time"></i></span>
                                    </div>
                                    @error('date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="input-group clockpicker" data-placement="top" data-align="top"
                            data-autoclose="true">
                            <input type="text" class="form-control" value="13:14">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="ti-time"></i></span>
                            </div>
                        </div> --}}

                        {{-- descreption --}}
                        <div class="form-row row">
                            <div>
                                <label for="description">Description:</label>
                                <textarea class="form-control" wire:model="description" id="description"></textarea>
                                @error('description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add changes</button>
                    </div>
                </form>
                {{-- END FORM --}}
            </div>
        </div>
    </div>

{{-- Modify Depense Modal --}}
{{-- @if ($selectedExpenseId) --}}
<div wire:ignore.self class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- FORM --}}
            <form wire:submit.prevent="update">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modifyModalLabel"> Ajouter depense </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- fournisseur --}}
                    <div class="form-row row">
                        <div class="form-group mb-3">
                            <label for="supplier_id">Fournisseur:</label>
                            <select class="form-control" wire:model="supplier_id" id="supplier_id">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->people->first_name }}
                                        {{ $supplier->people->last_name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Montant, paymentType --}}
                    <div class="form-row row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="amount">Montant:</label>
                            <input class="form-control" type="text" wire:model="amount" id="amount">
                            @error('amount')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="payment_type">Payment Type:</label>
                            <select class="form-control" wire:model="payment_type" id="payment_type">
                                <option value=""></option>
                                <option value="espece">Espèces</option>
                                <option value="cheque">Chèque</option>
                                <option value="carte_de_debit">Carte de débit</option>
                                <option value="carte_de_credit">Carte de crédit</option>
                            </select>
                            @error('payment_type')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- categorie --}}
                    <div class="form-row row">
                        <div class="form-group mb-3">
                            <label for="expense_category_id">Catégorie:</label>
                            <select class="form-control" wire:model="expense_category_id" id="expense_category_id">
                                @foreach ($expenseCategories as $category)
                                    <option value=""></option>
                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expense_category_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- cree par --}}
                    <div class="form-row row">
                        <div class="form-group mb-3">
                            <label for="user_id">Créé par:</label>
                            <select class="form-control" wire:model="user_id" id="user_id">
                                @foreach ($users as $user)
                                    <option value=""></option>
                                    <option value="{{ $user->id }}">{{ $user->people->first_name }}
                                        {{ $user->people->last_name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- date --}}
                    <div class="form-row row">
                        <div class="form-group mb-3">
                            <label for="date">Date:</label>
                            <input class="form-control" type="datetime" wire:model="date" id="date" readonly>
                            @error('date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- descreption --}}
                    <div class="form-row row">
                        <div>
                            <label for="description">Description:</label>
                            <textarea class="form-control" wire:model="description" id="description"></textarea>
                            @error('description')
                                <span class="error">{{ $message }}</span>
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
{{-- @endif --}}



























{{-- @if ($selectedExpenseId) --}}
{{-- <form wire:submit.prevent="store">
        <div>
            <label for="supplier_id">Fournisseur:</label>
            <select wire:model="supplier_id" id="supplier_id">
                <option value="">Select Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value=""></option>
                    <option value="{{ $supplier->id }}">{{ $supplier->people->first_name }}
                        {{ $supplier->people->last_name }}</option>
                @endforeach
            </select>
            @error('supplier_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="amount">Montant:</label>
            <input type="text" wire:model="amount" id="amount">
            @error('amount')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="payment_type">Payment Type:</label>
            <select wire:model="payment_type" id="payment_type">
                <option value=""></option>
                <option value="espece">Espèces</option>
                <option value="cheque">Chèque</option>
                <option value="carte_de_debit">Carte de débit</option>
                <option value="carte_de_credit">Carte de crédit</option>
            </select>
            @error('payment_type')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="expense_category_id">Catégorie:</label>
            <select wire:model="expense_category_id" id="expense_category_id">
                @foreach ($expenseCategories as $category)
                    <option value=""></option>
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            @error('expense_category_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="user_id">Créé par:</label>
            <select wire:model="user_id" id="user_id">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->people->first_name }}
                        {{ $user->people->last_name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>






        <button type="submit">Create Expense</button>
    </form> --}}
{{-- @endif --}}

</div>
</div>
