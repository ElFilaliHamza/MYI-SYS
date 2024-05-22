<div>
    <div class="conteneur">
        {{-- In work, do what you enjoy. --}}
        <div class="row container-fluid ">

            @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session()->has('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Full CARD --}}
            <div class="card col-md-8 col-lg-8 m-3">
                <div class="card-body">

                    <div class="conteneur">
                        <h1 class="card-title mb-2">Vente</h1>
                        <!-- // -->

                        <!-- // -->
                    </div>
                    <hr>

                    @if ($sale_id)
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col form-group">
                                <label for="customer_id">Client</label>
                                <select style="background-color: #afaeff07" wire:model="customer_id" class="form-control" id="customer_id">
                                    <option value="">Sélectionnez un client</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->person->first_name }}
                                        {{ $customer->person->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="col">
                                <label for="comment">L'emplacement:</label>
                                <select style="background-color: #afaeff07" wire:model="location_id" class="form-control">
                                    <option value="">Sélectionnez un emplacement</option>
                                    @foreach ($item_location as $location)
                                    <option value="{{ $location->id }}">{{ $location->location_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Champ pour sélectionner un article -->
                        <div class=" form-group">
                            <label for="item_id">Article</label>
                            <select style="background-color: #afaeff07" wire:model="item_id" wire:change="loadArticleDetails" class="form-control" id="item_id">
                                <option value="">Sélectionnez un article</option>
                                @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Tableau pour les articles vendus -->
                        <div class="pt-2">
                            <label for="item_id">Liste des articles selectionnés</label>
                            <table class="table table-hover ">
                                <thead class="bg-light">
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
                                        <td><input type="number" class="form-control" wire:model="selectedArticles.{{ $index }}.quantity_purchased">
                                        </td>
                                        <td><input type="number" class="form-control" wire:model="selectedArticles.{{ $index }}.unit_price">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger" wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
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

                        <!-- Champ pour le commentaire -->
                        <div class="form-group">
                            <label for="comment">Commentaire</label>
                            <textarea style="background-color: #afaeff07" wire:model="comment" class="form-control" id="comment"></textarea>
                            @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="p-3 row justify-content-end">
                            <div class=" col-auto badge text-bg-success fs-6">
                                Total à payer : {{ $TotalPayments }} MAD
                            </div>
                        </div>
                        {{-- <span>Total à payer : {{ $TotalPayments }} MAD</span> --}}
                        <div class="container">
                            <div class="row">
                                <!-- Champs pour les paiements -->
                                <div class="col-md-4">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Type de paiement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="btn-group-vertical" role="group" aria-label="Basic example" wire:model="P">
                                                        <button type="button" wire:click="selectPaymentType('espece')" class="btn btn-secondary p-2">Espèces</button>
                                                        <br>
                                                        <button type="button" wire:click="selectPaymentType('cheque')" class="btn btn-secondary">Chèque</button>
                                                        <br>
                                                        <button type="button" wire:click="selectPaymentType('carte_de_debit')" class="btn btn-secondary">Carte de débit</button>
                                                        <br>
                                                        <button type="button" wire:click="selectPaymentType('carte_de_credit')" class="btn btn-secondary">Carte de crédit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                {{-- les paiments effectuer --}}
                                <div class="col-md-8">
                                    <table class="table table-hover">
                                        <thead class="bg-light">
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
                                                    <input type="text" id="payment_amount" wire:model.live="payments.{{ $index }}.payment_amount" class="form-control">
                                                </td>
                                                <td>
                                                    @if ($payment['payment_type'] == 'espece')
                                                    <input type="number" wire:model="payments.{{ $index }}.cash_refund" class="form-control">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment['payment_type'] == 'espece')
                                                    <input type="number" wire:model="payments.{{ $index }}.cash_adjustment" class="form-control">
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" wire:click="removePayment({{ $loop->index }})">Supprimer</button>
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


                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-danger " wire:click="$set('sale_status', 1)">
                                    Annuler la Vente</button>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" wire:click="$set('sale_status', 0)">
                                    Complete la vente</button>
                            </div>

                        </div>

                    </form>
                    @else
                    <form wire:submit.prevent="store">

                        <div class="row">
                            <div class="col form-group">
                                <label for="customer_id">Client</label>
                                <select style="background-color: #afaeff07" wire:model="customer_id" class="form-control" id="customer_id">
                                    <option value="">Sélectionnez un client</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->person->first_name }}
                                        {{ $customer->person->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="comment">L'emplacement:</label>
                                <select style="background-color: #afaeff07" wire:model="location_id" class="form-control">
                                    <option value="">Sélectionnez un emplacement</option>
                                    @foreach ($item_location as $location)
                                    <option value="{{ $location->id }}">{{ $location->location_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Champ pour sélectionner un article -->
                        <div class=" form-group pt-2">
                            <label for="item_id">Article</label>
                            <select style="background-color: #afaeff07" wire:model="item_id" wire:change="loadArticleDetails" class="form-control" id="item_id">
                                <option value="">Sélectionnez un article</option>
                                @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Tableau pour les articles vendus -->
                        <div class="pt-2">
                            <label for="item_id">Liste des articles selectionnés</label>
                            <table class="table table-hover ">
                                <thead class="bg-light">
                                    <tr>
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
                                        <td><input type="number" class="form-control" wire:model.live="selectedArticles.{{ $index }}.quantity_purchased">
                                        </td>
                                        <td><input type="number" class="form-control" wire:model="selectedArticles.{{ $index }}.unit_price">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger" wire:click="removeArticle({{ $loop->index }})">Supprimer</button>
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

                        <div class="p-2 row justify-content-end">
                            <div class=" col-auto badge text-bg-success fs-6">
                                Total à payer : {{ $TotalPayments }} MAD
                            </div>
                        </div>

                        <div class="row">
                            <!-- Champs pour les paiements -->
                            <div class="col-2">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Type de paiement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="btn-group-vertical" role="group" aria-label="Basic example" wire:model="P">
                                                    <button type="button" wire:click="selectPaymentType('espece')" class="btn btn-secondary p-2">Espèces</button>
                                                    <br>
                                                    <button type="button" wire:click="selectPaymentType('cheque')" class="btn btn-secondary">Chèque</button>
                                                    <br>
                                                    <button type="button" wire:click="selectPaymentType('carte_de_debit')" class="btn btn-secondary">Carte de débit</button>
                                                    <br>
                                                    <button type="button" wire:click="selectPaymentType('carte_de_credit')" class="btn btn-secondary">Carte de crédit</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- les paiments effectuer --}}
                            <div class="col-10">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Type de paiement</th>
                                            <th>Montant du paiement</th>
                                            <th>Date d'échéance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($payments)
                                        @foreach ($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $payment['payment_type'] }}</td>
                                            <td>
                                                <input type="text" id="payment_amount" wire:model="payments.{{ $index }}.payment_amount" class="form-control">
                                            </td>
                                            <td>
                                                @if($payment['payment_type'] == 'cheque')
                                                <input type="date" wire:model="payments.{{ $index }}.date_cheque" class="form-control">
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger" wire:click="removePayment({{ $loop->index }})">Supprimer</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="row-cols-auto">
                                            <td>Aucun paiement effectué</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- Champ pour le commentaire -->
                        <div class="form-group">
                            <label for="comment">Commentaire</label>
                            <textarea style="background-color: #afaeff07" wire:model="comment" class="form-control" id="comment"></textarea>
                            @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row justify-content-end pt-3">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-primary " wire:click="$set('sale_status', 1)">
                                    Suspendre la Vente</button>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-success" wire:click="$set('sale_status', 0)">
                                    Complete la vente</button>
                            </div>


                        </div>

                    </form>
                    @endif
                </div>
            </div>

            {{-- Panier --}}
            <div class="panier-card card col-md-3 col-lg-3 m-3" style="background-color: #e2eafc; height:fit-content">
                <div class="card-body">
                    {{-- header of the card --}}
                    <div class="conteneur">
                        <h1 class="card-title mb-2">Checkout</h1>
                    </div>
                    {{-- search row  --}}
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Numéro de facture</div>
                            <div class="pb-2">
                                <input wire:model="invoice_number" type="text" class="form-control" id="invoice_number" readonly>
                                @error('invoice_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                    </div>
                    {{-- table of date --}}
                    <div class="table-responsive">
                        <div>
                            @if ($selectedArticles)
                            @foreach ($selectedArticles as $index => $selected)
                            <!-- Product List -->
                            <div class="d-flex justify-content-between align-items-center ">
                                <div>
                                    <label for="">Product: </label>
                                    <label>{{ $selected['name'] }}</label>
                                </div>
                                <div>
                                    <label wire:model="selectedArticles.{{ $index }}.unit_price">{{ $selected['unit_price'] }} MAD</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <label>Quantite =</label>
                                    <input type="text" wire:model.live="selectedArticles.{{ $index }}.quantity_purchased" class="form-control d-inline-block text-center" value="1" readonly>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            @else
                            <!-- Product List -->
                            <div class="d-flex justify-content-between align-items-center ">
                                <div>
                                    <label for="">Le panier est vide</label>
                                </div>
                            </div>
                            <hr>
                            @endif
                        </div>

                        {{-- Table de paiement --}}
                        <div class="pt-3">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Type de paiement</th>
                                        <th>Montant du paiement</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-light">
                                    @if ($payments)
                                    @foreach ($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $payment['payment_type'] }}</td>
                                        <td>
                                            <input type="text" id="payment_amount" wire:model.live="payments.{{ $index }}.payment_amount" class="form-control" readonly>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="2">Aucun payment selectionné</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

</div>