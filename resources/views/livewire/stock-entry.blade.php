<div>
    <div class="card">
        <div class="card-body">
            <div class="row container-fluid ">
                <div class="card col m-3">
                    <div class="conteneur">
                        <h1 class="card-title mb-2">Entrer stock</h1>
                        <div class="conteneur-button">
                            {{-- <button type="button" class="btn btn-outline-secondary " data-bs-toggle="modal"
                        data-bs-target="#modalCreate" wire:model.live="search">
                        Ajouter article
                    </button> --}}
                        </div>
                    </div>
                    {{-- <div class="conteneur">
                    <p class="mb-30">Add class <code>.table-hover</code></p>
                    <div>
                        <input type="text" wire:model.live='search'>
                        <input type="text" class="form-control" type="text" wire:model.live="search"
                            placeholder="Search article..." aria-label="Default"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    </div> --}}

                    <div class="container-fluid pt-3">
                        <div class="row  p-2 mb-4 ">

                            <div class="col">
                                <label for="suppliers">Fournisseurs :</label>
                                <select class="form-control" wire:model="supplier_id">
                                    <option value="">Choisir un fournisseur (facultatif)</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->people->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="mode_reception">Mode réception :</label>
                                <select wire:change="displaySelectedItem" class="form-control" name="receiving_type"
                                    wire:model="receiving_type">
                                    <option value="reception">Réception</option>
                                    <option value="retour">Retour</option>
                                    <option value="requisition">Réquisition</option>
                                </select>

                            </div>

                            <div class="col">
                                <label for="locations">Stock source:</label>
                                <select class="form-control" wire:model="stock_source">
                                    <option value="">Sélectionnez un stock</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($receiving_type == 'requisition')

                                <div class="col">
                                    <label for="locations">Stock destination :</label>
                                    <select class="form-control" wire:model="stock_destination">
                                        <option value="">Sélectionnez un stock</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            @endif
                            <div class="pb-2 pt-2">
                                <label for="article">Article:</label>
                                <select class="form-control" wire:model="selectedItemId"
                                    wire:change="displaySelectedItem">
                                    <option value="">Sélectionnez un article</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">



                            <div>

                                @if ($receiving_type !== 'requisition')

                                    @if ($selectedItem)
                                        <div>
                                            <h3>Informations de l'article sélectionné</h3>
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>#Article</th>
                                                    <th>Nom d'article</th>
                                                    <th>Coût</th>
                                                    <th>Quantité</th>
                                                    <th>Commentaire</th>
                                                    <th>Référence</th>
                                                    <th>Total</th>
                                                </tr>
                                                @foreach ($selectedItems as $item)
                                                    <tr>
                                                        <td>{{ $item['item']->item_number }}</td>
                                                        <td>{{ $item['item']->name }}</td>
                                                        <td>{{ $item['item']->cost_price }}</td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                wire:model.live="{{ $item['item']->quantity }}"
                                                                wire:change="updateTotal($event.target.value, {{ $item['item']->id }} )"
                                                                min="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="comment">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                wire:model.defer="reference">
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                style="background-color: rgba(128, 128, 128, 0.105)"
                                                                class="form-control" value="{{ $item['total'] }} MAD"
                                                                name="" id="" readonly>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table>
                                        </div>
                                        {{-- <div>
                                            <h5>Montant présenté</h5>
                                            <input class="form-control" type="number"
                                                wire:model.defer="montant_presente" min="0">
                                            <h5>Type de paiement</h5>
                                            <select class="form-control" wire:model.defer="payment_type">
                                                <option value="Espèce">Espèce</option>
                                                <option value="chèque">Chèque</option>
                                                <option value="carteDebit">Carte de débit</option>
                                                <option value="carteCredit">Carte de crédit</option>
                                            </select><br>
                                            <button class="form-control" wire:click="showPayment">add payment</button>
                                            <h5>Montant à payer</h5>
                                            <input class="form-control" type="text" name="" id=""
                                                value="{{ $total }}" readonly>
                            </div>

                            <table class="table table-hover">
                                <tr>
                                    <th>payment type</th>
                                    <th>payment amount</th>
                                </tr>
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment['payment_type'] }}</td>
                                    <td>{{ $payment['montant_presente'] }}</td>
                                </tr>
                                @endforeach
                            </table>



                            <button class="form-control" wire:click="validateOperation">Valider</button>
                            <button class="form-control" wire:click="cancelOperation">Annuler</button> --}}
                                    @endif


                                @endif
                            </div>

                            @if ($receiving_type == 'requisition')

                                @if ($selectedItem)
                                    <div>
                                        <h3>Informations de l'article sélectionné</h3>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>#Article</th>
                                                <th>Nom d'article</th>
                                                <th>Coût</th>
                                                <th>Quantité</th>
                                                <th>Commentaire</th>
                                            </tr>
                                            @foreach ($selectedItems as $item)
                                                <tr>
                                                    <td>{{ $item['item']->item_number }}</td>
                                                    <td>{{ $item['item']->name }}</td>
                                                    <td>{{ $item['item']->cost_price }}</td>
                                                    <td>
                                                        <input type="number" class="form-control"
                                                            wire:model.live="{{ $item['item']->quantity }}"
                                                            wire:change="updateTotal($event.target.value, {{ $item['item']->id }} )"
                                                            min="1">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text"
                                                            wire:model.defer="comment">
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-danger"
                                            wire:click="cancelOperation">Annuler</button>
                                        <button class="btn btn-primary m-2"
                                            wire:click="validateOperation">Valider</button>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>


                @if ($receiving_type !== 'requisition')
                    {{-- Panier --}}
                    <div class="panier-card card col col-lg-3 m-3"
                        style="background-color: #e2eafc; height:fit-content">
                        <div class="card-body">{{-- header of the card --}}
                            <div class="conteneur">
                                <h1 class="card-title mb-1">Paiment</h1>
                            </div>
                            <hr>
                            <div>
                                @if ($selectedItem)
                                    <div>
                                        <div>
                                            <div class="conteneur pt-3 ">
                                                <h5 class="col-6">Montant à payer</h5>
                                                <input style="background-color: #f9f5ff" class="form-control col"
                                                    type="text" name="" id=""
                                                    value="{{ $total }} MAD" readonly>
                                            </div>
                                            <div class="pt-3">
                                                <h5>Montant présenté</h5>
                                                <input style="background-color: #f9f5ff" class="form-control"
                                                    type="number" wire:model.defer="montant_presente">
                                            </div>
                                            <div class="pt-3">
                                                <div class="row">
                                                    <h5>Type de paiement</h5>
                                                </div>
                                                <select style="background-color: #f9f5ff" class="form-control"
                                                    wire:model.defer="payment_type">
                                                    <option value="Espèce">Espèce</option>
                                                    <option value="chèque">Chèque</option>
                                                    <option value="carteDebit">Carte de débit</option>
                                                    <option value="carteCredit">Carte de crédit</option>
                                                </select>
                                                <div class="row justify-content-end pt-2 pb-3">
                                                    <div class="col-6 ">
                                                        <button class="form-control btn btn-primary" wire:click='showPayment'>add</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @if ($payments)

                                            <div class="">
                                                <table style="background-color: #f9f5ff" class="table table-hover">
                                                    <tr>
                                                        <th>payment type</th>
                                                        <th>payment amount</th>
                                                    </tr>
                                                    @foreach ($payments as $payment)
                                                        <tr>
                                                            <td>{{ $payment['payment_type'] }}</td>
                                                            <td>{{ $payment['montant_presente'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @endif
                                        <div class="conteneur footer-content">
                                            <button class="form-control btn btn-danger"
                                                wire:click="cancelOperation">Annuler</button>
                                            <button name="1" class="form-control btn btn-primary"
                                                wire:click="validateOperation">Valider</button>
                                        </div>
                                    </div>
                                @endif


                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
