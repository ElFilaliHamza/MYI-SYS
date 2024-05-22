<div>
    {{-- <div class="conteneur"> --}}

        <div class="conteneur">
            <div class="row ">
                <!-- Main Column -->
                <div class="card col-md-8 m-2">
                    {{-- title with buttons --}}
                    <div class="mb-1 p-1 ">
                        <h1 class="card-title mb-2">Vente</h1>
                        <div class="conteneur-button">
                            <button type="submit" wire:click="indexSuspendre" class="btn btn-primary">Ventes
                                Suspendues</button>
                            <button type="submit" wire:click="indexComplete" class="btn btn-primary">Ventes
                                Complete</button>
                        </div>
                    </div>

                    <div class="mb-1 p-1 "> {{-- Suspendu vente table  --}}
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
                                            <td>{{ $sale->customer->person->first_name }}
                                                {{ $sale->customer->person->last_name }}</td>
                                            <td>{{ $sale->user->people->first_name }}
                                                {{ $sale->user->people->last_name }}</td>
                                            <td>{{ $sale->comment }}</td>
                                            <!-- <td>
                                        <button wire:click="unlockSale({{ $sale->id }})" type="button" class="btn btn-outline-danger">Débloquer</button>
                                    </td> -->
                                            <!-- pour modifier la vente complete seulment -->
                                            <td>
                                                <button type="button" class="btn btn-outline-success"
                                                    wire:click="edit({{ $sale->id }})">Modifier</button>
                                            </td>
                                            <td>
                                                <button wire:click="generateInvoice({{ $sale->id }})"
                                                    class="btn btn-success">Générer Facture</button>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    
                    <div class="mb-1 p-1 "> {{-- numero de facture  --}}
                        <label for="invoice_number">Numéro de facture</label>
                        <div class="conteneur-button">
                            <input style="background-color: #f0f0f0;" wire:model="invoice_number" type="text"
                                class="form-control" id="invoice_number" readonly>
                            @error('invoice_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <form>

                        {{-- client and emplacement input --}}
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="p-1 ">
                                    <label for="customer_id">Client</label>
                                    <select style="background-color: #afaeff07" wire:model="customer_id"
                                        class="form-control" id="customer_id">
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
                            </div>
                            <div class="col-md-6">
                                <div class="p-1 ">
                                    <label for="comment">L'emplacement:</label>
                                    <select style="background-color: #afaeff07" wire:model="location_id"
                                        class="form-control">
                                        <option value="">Sélectionnez un emplacement</option>
                                        @foreach ($item_location as $location)
                                            <option value="{{ $location->id }}">{{ $location->location_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 p-1 ">
                            <label for="item_id">Article</label>
                            <select style="background-color: #afaeff07" wire:model="item_id"
                                wire:change="loadArticleDetails" class="form-control" id="item_id">
                                <option value="">Sélectionnez un article</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- table des articles selectionnes --}}
                        <div class="mb-1 p-1 ">
                            <label for="item_id">Liste des articles selectionnés</label>
                            <table class="table table-hover ">
                                <thead>
                                    <tr style="background-color: #afaeff07">
                                        <th>Article</th>
                                        <th>Quantité</th>
                                        <th>Prix d'achat</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectedArticles)
                                        @foreach ($selectedArticles as $index => $selected)
                                            <tr style="background-color: #afaeff07">
                                                <td>{{ $selected['name'] }}</td>
                                                <td><input type="number" class="form-control"
                                                        wire:model="selectedArticles.{{ $index }}.quantity_purchased">
                                                </td>
                                                <td><input type="number" class="form-control"
                                                        wire:model="selectedArticles.{{ $index }}.unit_price">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr style="background-color: #afaeff07">
                                            <td>Aucun article selectionner</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- comments input --}}
                        <div class="mb-1 p-1 ">
                            <label for="comment">Commentaire</label>
                            <textarea style="background-color: #afaeff07" wire:model="comment" class="form-control" id="comment"></textarea>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-1 p-1 ">
                            <div class=" col-auto badge text-bg-success fs-6">
                                Total à payer : {{ $TotalPayments }} MAD
                            </div>
                        </div>
                        <div class="row">

                            {{-- table de type de paiment --}}
                            <div class="col-md-4">
                                <div class="p-1 ">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Type de paiement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="btn-group-vertical" role="group"
                                                        aria-label="Basic example" wire:model="P">
                                                        <button type="button" wire:click="selectPaymentType('espece')"
                                                            class="btn btn-secondary p-2">Espèces</button>
                                                        <br>
                                                        <button type="button" wire:click="selectPaymentType('cheque')"
                                                            class="btn btn-secondary">Chèque</button>
                                                        <br>
                                                        <button type="button"
                                                            wire:click="selectPaymentType('carte_de_debit')"
                                                            class="btn btn-secondary">Carte de débit</button>
                                                        <br>
                                                        <button type="button"
                                                            wire:click="selectPaymentType('carte_de_credit')"
                                                            class="btn btn-secondary">Carte de crédit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- table des paiments effectue --}}
                            <div class="col-md-8">
                                <div class="p-1 ">
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
                                            @if ($payments)
                                                @foreach ($payments as $index => $payment)
                                                    <tr>
                                                        <td>{{ $payment['payment_type'] }}</td>
                                                        <td>
                                                            <input type="text" id="payment_amount"
                                                                wire:model.live="payments.{{ $index }}.payment_amount"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            @if ($payment['payment_type'] == 'espece')
                                                                <input type="number"
                                                                    wire:model="payments.{{ $index }}.cash_refund"
                                                                    class="form-control">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($payment['payment_type'] == 'espece')
                                                                <input type="number"
                                                                    wire:model="payments.{{ $index }}.cash_adjustment"
                                                                    class="form-control">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-danger"
                                                                wire:click="removePayment({{ $loop->index }})">Supprimer</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="row-cols-auto">
                                                    <td>Aucun paiement effectué</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if ($sale_id)
                            <div class="mb-1 p-1 ">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-danger "
                                        wire:click="$set('sale_status', 1)">
                                        Annuler Vente</button>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"
                                        wire:click="$set('sale_status', 0)">
                                        Complete la vente</button>
                                </div>
                            </div>
                        @else
                            <div class="mb-1 p-1 ">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-danger "
                                        wire:click="$set('sale_status', 1)">
                                        Annuler Vente</button>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"
                                        wire:click="$set('sale_status', 0)">
                                        Complete la vente</button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- PANIER Column -->
                <div class="card col-md-3 m-2">
                    <div class="mb-1 p-1 ">
                        <h1 class="card-title mb-2">Checkout</h1>
                    </div>

                    {{-- num facture --}}
                    <div class="mb-1 p-1 ">
                        <div>Numéro de facture</div>
                        <div class="pb-2">
                            <input wire:model="invoice_number" type="text" class="form-control"
                                style="background-color: #f0f0f0;" id="invoice_number" readonly>
                            @error('invoice_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- liste des produits --}}
                    <div class="mb-1 p-1 ">
                        @if ($selectedArticles)
                            @foreach ($selectedArticles as $index => $selected)
                                <!-- Product List -->
                                <div class="d-flex justify-content-between align-items-center ">
                                    <div>
                                        <label for="">Product: </label>
                                        <label>{{ $selected['name'] }}</label>
                                    </div>
                                    <div>
                                        {{-- <input type="number" wire:model="selectedArticles.{{ $index }}.unit_price">
                            --}}
                                        <label
                                            wire:model="selectedArticles.{{ $index }}.unit_price">{{ $selected['unit_price'] }}MAD</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        {{-- <button class="btn btn-outline-secondary btn-sm">-</button> --}}
                                        {{-- <a href="" class="">-</a> --}}
                                        <label>Quantite =</label>
                                        {{-- <textarea
                                wire:model.live="selectedArticles.{{ $index }}.quantity_purchased"></textarea>
                            --}}
                                        <input type="text"
                                            wire:model.live="selectedArticles.{{ $index }}.quantity_purchased"
                                            class="form-control d-inline-block text-center" value="1"
                                            style="width: 50px; background-color: #f0f0f0;" readonly>
                                        {{-- <button class="btn btn-outline-secondary btn-sm">+</button> --}}
                                        {{-- <a href="">+</a> --}}
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <!-- Product List -->
                            <div class="d-flex justify-content-between align-items-center ">
                                <div>
                                    <label for="">La panier est vide </label>
                                </div>

                            </div>
                            <hr>
                        @endif
                    </div>
                    <div class="mb-1 p-1 ">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Type de paiement</th>
                                    <th>Montant du paiement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($payments)
                                    @foreach ($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $payment['payment_type'] }}</td>
                                            <td>
                                                <input style="background-color: #f0f0f0;" type="text"
                                                    id="payment_amount"
                                                    wire:model.live="payments.{{ $index }}.payment_amount"
                                                    class="form-control" readonly>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2"">There's no paiment yet</td>
                                        <td></td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="mb-1 p-1 ">Totale = 1005 MAD</div>
                </div>
            </div>
        </div>
</div>
