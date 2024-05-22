<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session()->has('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <button type="submit" wire:click="index" class="btn btn-primary">Ventes Suspendues</button>

    <div>
        @if ($showSuspendedSales)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date de vente</th>
                        <th>Client</th>
                        <th>Employe</th>
                        <th>Commentaires</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_time }}</td>
                            <td>{{ $sale->customer->person->first_name }} {{ $sale->customer->person->last_name }}</td>
                            <td>{{ $sale->user->people->first_name }} {{ $sale->user->people->last_name }}</td>
                            <td>{{ $sale->comment }}</td>
                            <td>
                                <button wire:click="unlockSale({{ $sale->id }})" type="button"
                                    class="btn btn-outline-danger">Débloquer</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <form wire:submit.prevent="store">
        <!-- Champs pour le client -->
        <div class="form-group">
            <label for="customer_id">Client</label>
            <select wire:model="customer_id" class="form-control" id="customer_id"
                wire:change="validateField('customer_id')">
                <option value="">Sélectionnez un client</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->person->first_name }}
                        {{ $customer->person->last_name }}</option>
                @endforeach
            </select>
            @error('customer_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ pour le numéro de facture -->
        <div class="form-group">
            <label for="invoice_number">Numéro de facture</label>
            <input wire:model="invoice_number" type="text" class="form-control" id="invoice_number" readonly>
            @error('invoice_number')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ pour le commentaire -->
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea wire:model="comment" class="form-control" id="comment" wire:change="validateField('comment')"></textarea>
            @error('comment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ pour sélectionner un article -->
        <div class="form-group">
            <label for="item_id">Sélectionnez un article</label>
            <input list="item_list" wire:model="item_id" wire:change="loadArticleDetails" class="form-control"
                id="item_id" placeholder="Sélectionnez un article">
            <datalist id="item_list">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </datalist>
            @error('item_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <!-- Tableau pour les articles vendus -->
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Quantité</th>
                        <th>Prix d'achat</th>
                        <th>Emplacement</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedArticles as $index => $selected)
                        <tr>
                            <td>{{ $selected['name'] }}</td>
                            <td><input type="number"
                                    wire:model="selectedArticles.{{ $index }}.quantity_purchased"></td>
                            <td><input type="number" wire:model="selectedArticles.{{ $index }}.unit_price">
                            </td>
                            <td>
                                <select wire:model="selectedArticles.{{ $index }}.item_location"
                                    class="form-control">
                                    <option value="">Sélectionnez un emplacement</option>
                                    @foreach ($item_locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger"
                                    wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Champs pour les paiements -->
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type de paiement</th>
                        <!-- <th>Montant du paiement</th>
                <th>Remboursement en espèces</th>
                <th>Ajustement en espèces</th> -->
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select wire:model="payment_type" class="form-control" wire:change="addPayment">
                                <option value="">Sélectionner le mode de paiement</option>
                                <option value="espece">Espèces</option>
                                <option value="cheque">Chèque</option>
                                <option value="carte_de_debit">Carte de débit</option>
                                <option value="carte_de_credit">Carte de crédit</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Table de paiemet --}}
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type de paiement</th>
                        <th>Montant du paiement</th>
                        <th>Remboursement en espèces</th>
                        <th>Ajustement en espèces</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $index => $payment)
                        <tr>
                            <td>{{ $payment['payment_type'] }}</td>
                            <td>
                                <input type="text" id="payment_amount" wire:model="payment_amount"
                                    class="form-control" readonly>
                            </td>
                            <td>
                                @if ($payment['payment_type'] == 'espece')
                                    <input type="number" wire:model="payments.{{ $index }}.cash_refund"
                                        class="form-control">
                                @endif
                            </td>
                            <td>
                                @if ($payment['payment_type'] == 'espece')
                                    <input type="number" wire:model="payments.{{ $index }}.cash_adjustment"
                                        class="form-control">
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger"
                                    wire:click="removePayment({{ $loop->index }})">Supprimer</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


        <button type="submit" class="btn btn-primary" wire:click="$set('sale_status', 0)">Créer Vente</button>
        <button type="submit" class="btn btn-warning" wire:click="$set('sale_status', 1)">Suspendre Vente</button>

    </form>

</div>
