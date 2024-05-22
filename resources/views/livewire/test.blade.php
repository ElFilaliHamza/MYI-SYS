<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
</head>
<body>
    <h1>Facture</h1>
    
    <p>Numéro de facture : {{ $sale->invoice_number }}</p>
    
    <p>Client : {{ $customer->person_id }}</p>
    <!-- Ajoutez d'autres informations du client selon vos besoins -->

    <h2>Détails de la vente :</h2>
    <table>
        <thead>
            <tr>
                <th>#Article</th>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salesItems as $item)
                <tr>
                    <td>{{ $item->item->item_number }}</td>
                    <td>{{ $item->item->name }}</td>
                    <td>{{ $item->quantity_purchased }}</td>
                    <td>{{ $item->item_unit_price }}</td>
                    <td>{{ $item->item_unit_price * $item->quantity_purchased }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total des paiements : {{ $totalPayments }}</p>
    <!-- Ajoutez d'autres informations sur les paiements si nécessaire -->
</body>
</html>



