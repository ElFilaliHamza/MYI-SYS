<div>

    <div>
        <label for="suppliers">Fournisseurs :</label>
        <select wire:model="supplier_id">
            <option value="">Choisir un fournisseur (facultatif)</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->people->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="mode_reception">Mode réception :</label>
        <select name="receiving_type" wire:model="receiving_type">
            <option value="reception">Réceptionner</option>
            <option value="retour">Retour</option>
            <option value="requisition">Réquisition</option>
        </select>

    </div>

    <div>
        <label for="locations">Stock source:</label>
        <select wire:model="stock_source">
            <option value="">Sélectionnez un stock</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
            @endforeach
        </select>
    </div>

    @if ($receiving_type == 'requisition')

        <div>
            <label for="locations">Stock destination :</label>
            <select wire:model="stock_destination">
                <option value="">Sélectionnez un stock</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                @endforeach
            </select>
        </div>

    @endif

    <div>
        <div>
            <label for="article">Article:</label>
            <select wire:model="selectedItemId" wire:change="displaySelectedItem">
                <option value="">Sélectionnez un article</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        @if ($receiving_type !== 'requisition')
            @if ($selectedItem)
                <div>
                    <h3>Informations de l'article sélectionné</h3>
                    <table>
                        <tr>
                            <th>#Article</th>
                            <th>Nom d'article</th>
                            <th>Coût</th>
                            <th>Quantité</th>
                            <th>Commentaire</th>
                            <th>Référence</th>
                            <th>Total</th>
                            <th>Action</th> <!-- Add a new column for the delete button -->
                        </tr>
                        @foreach ($selectedItems as $index => $item)
                            <!-- Include an index for each item -->
                            <tr>
                                <td>{{ $item['item']->item_number }}</td>
                                <td>{{ $item['item']->name }}</td>
                                <td>{{ $item['item']->cost_price }}</td>
                                <td>
                                    <input type="number" wire:model.live="selectedItems.{{ $index }}.quantity"
                                        wire:change="updateTotal($event.target.value, {{ $item['item']->id }} )"
                                        min="1">
                                </td>
                                <td>
                                    <input type="text" wire:model.defer="selectedItems.{{ $index }}.comment">
                                </td>
                                <td>
                                    <input type="text"
                                        wire:model.defer="selectedItems.{{ $index }}.reference">
                                </td>
                                <td>
                                    {{ $item['total'] }}
                                </td>
                                <td>
                                    <button wire:click="removeSelectedItem({{ $index }})">Supprimer</button>
                                    <!-- Add a button to remove the item -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div>
                    <h5>Montant présenté</h5>
                    <input type="number" wire:model.defer="montant_presente" min="0">
                    <h5>Type de paiement</h5>
                    <select wire:model.defer="payment_type">
                        <option value="Espèce">Espèce</option>
                        <option value="chèque">Chèque</option>
                        <option value="carteDebit">Carte de débit</option>
                        <option value="carteCredit">Carte de crédit</option>
                    </select><br>
                    <button wire:click="showPayment">add payment</button>
                    <h5>Montant à payer</h5>
                    {{ $total }}
                </div>

                <table>
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

                <button wire:click="validateOperation">Valider</button>
                <button wire:click="cancelOperation">Annuler</button>
            @endif
        @endif


        @if ($receiving_type == 'requisition')
            @if ($selectedItem)
                <div>
                    <h3>Informations de l'article sélectionné</h3>
                    <table>
                        <tr>
                            <th>#Article</th>
                            <th>Nom d'article</th>
                            <th>Coût</th>
                            @foreach ($locations as $location)
                                <th>Quantité ({{ $location->location_name }})</th>
                            @endforeach
                            <th>Quantité à transférer</th>
                            <th>Commentaire</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($selectedItems as $index => $item)
                            <tr>
                                <td>{{ $item['item']->item_number }}</td>
                                <td>{{ $item['item']->name }}</td>
                                <td>{{ $item['item']->cost_price }}</td>
                                @foreach ($item['item_quantities'] as $quantity)
                                    <td>{{ $quantity }}</td>
                                @endforeach
                                <td>
                                    <input type="number" wire:model.live="selectedItems.{{ $index }}.quantity"
                                        wire:change="updateTotal($event.target.value, {{ $item['item']->id }} )"
                                        min="1">
                                </td>
                                <td>
                                    <input type="text" wire:model.defer="selectedItems.{{ $index }}.comment">
                                </td>
                                <td>
                                    <button wire:click="removeSelectedItem({{ $index }})">Supprimer</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <button wire:click="validateOperation">Valider</button>
                <button wire:click="cancelOperation">Annuler</button>
            @endif
        @endif


    </div>
</div>
</div>

