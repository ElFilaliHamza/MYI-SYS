<div>
    {{-- Be like water. --}}
    <button type="submit" wire:click="indexSuspendre" class="btn btn-primary">Ventes Suspendues</button>
    <button type="submit" wire:click="indexComplete" class="btn btn-primary">Ventes Complete</button>

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
</div>
