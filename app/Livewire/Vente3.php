<?php

namespace App\Livewire;

use App\Models\Customers;
use App\Models\ItemQuantities;
use App\Models\Items;
use App\Models\Sales;
use App\Models\SalesItems;
use App\Models\SalesPayments;
use Livewire\Component;
use App\Models\StockLocation;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;


class Vente3 extends Component
{
    
    public $customer_id;
    public $comment;
    public $invoice_number;
    public $sale_status;
    public $user_id;
    public $item_id;
    public $quantity_purchased=1;
    public $item_cost_price;
    public $item_unit_price;
    public $item_location;
    public $items;
    public $customers;
    public $selectedArticles = [];
    public $payments = [];
    public $payment_type ;
    public $payment_amount;
    public $cash_refund;
    public $cash_adjustment;
    public $sales;
    public $sale_id;
    public $location_id;
    public $generaFacture;

    public $selectedSalesId;
    public $TotalPayments;
    public $dompdf;
    public $viewName = 'livewire.services.invoice-pdf';


    protected $rules = [
        'customer_id' => 'required|integer',
        'comment' => 'nullable|string|max:255',
        'item_id' => 'required|integer', 
        'quantity_purchased' => 'required|numeric|min:1', 
        'payment_type' => 'required|string', 
    ];

    public function render()
    {
        $this->loadItems();
        $this->loadCustomers();
        $this->loadStockLocations();
        $this->generateInvoiceNumber();
        $this->quantity_purchased = 1;
        $this->TotalPayments = $this->getTotalAmount();
        
        return view('livewire.vente3', [
            'customers' => $this->customers,
            'items' => $this->items,
            'item_location' => $this->item_location,
        ]);
    }
    private function loadItems()
    {
        $this->items = Items::where('deleted', 0)
            ->join('item_quantities', 'items.id', '=', 'item_quantities.item_id')
            ->select('items.*')            
            ->distinct()
            ->get();
    }
    private function loadCustomers()
    {
        $this->customers = Customers::where('deleted', 0)->with('person')->get();
    }
    private function loadStockLocations()
    {
        $this->item_location = StockLocation::where('deleted', 0)->get();
    }
    
    private function generateInvoiceNumber()
        {
            $last_invoice_number = Sales::max('id');
            $next_invoice_number = $last_invoice_number + 1;
            $this->invoice_number = 'F' . date('Y') . '-' . str_pad($next_invoice_number, 4, '0', STR_PAD_LEFT);
        }
    public function generateInvoice($saleId)
    {
       
        $sale = Sales::findOrFail($saleId);
        $customer = Customers::findOrFail($sale->customer_id);
        $salesItems = SalesItems::where('sale_id', $saleId)->get();
        $totalPayments = SalesPayments::where('sale_id', $saleId)->sum('payment_amount');
        $htmlContent = view($this->viewName)
        ->with(['sale'=>$sale, 'customer'=>$customer,'salesItems'=>$salesItems,'totalPayments'=>$totalPayments])
        ->render();
 
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfContent = $dompdf->output();
        return Response::streamDownload(
            function () use ($pdfContent) {
                print($pdfContent);
            },
            'facture.pdf'
        );
    }
    public $showSuspendedSales = false;
    public function indexSuspendre()
    {
        $this->showSuspendedSales = !$this->showSuspendedSales;
        $this->sales = Sales::where('sale_status', 1)->get();
    }
    public function indexComplete()
    {
        $this->showSuspendedSales = !$this->showSuspendedSales;
        $this->sales = Sales::where('sale_status', 0)->get();
    }

    public function loadPaymentDetails()
    {
        $isExist = false;
        foreach($this->payments as $payment){
            if($payment['payment_type'] == $this->payment_type){
                $isExist = true;
                break;
            }
        }
        if (!empty($this->payment_type) && !$isExist) {
            $this->payments[] = [
                'payment_type' => $this->payment_type,
                'payment_amount' => $this->payment_amount,
                'cash_refund' => $this->cash_refund,
                'cash_adjustment' => $this->cash_adjustment,
            ];
            
        }
    }
    public function selectPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
        $this->loadPaymentDetails(); 
    }

    public function loadArticleDetails()
    {
        $isExist = false;
        foreach($this->selectedArticles as $article){
            if($article['id'] == $this->item_id){
                $isExist = true;
                break;
            }
        }
        if (!empty($this->item_id) &&  !$isExist) {
            $articleDetails = Items::findOrFail($this->item_id);
            $this->selectedArticles[] = [
                'id' => $articleDetails->id,
                'name' => $articleDetails->name,
                'unit_price' => $articleDetails->unit_price,
                'item_location' => $articleDetails->item_location,
                'quantity_purchased' => $articleDetails->quantity_purchased,
                'cost_price' => $articleDetails->cost_price,
            ];
        }
    }

    //cette methode pour le bouton supprimer de la table des article selectionne 
    public function removeArticle($index)
    {
        if (array_key_exists($index, $this->selectedArticles)) {
            unset($this->selectedArticles[$index]);
        }
    }
    //et cette methode pour le bouton supprimer de la table des payments
    public function removePayment($index)
    {
        if (array_key_exists($index, $this->payments)) {
            unset($this->payments[$index]);
        }
    }
    
    // Méthode pour créer une vente complète
    public function store()
    {
        $salesItems = null;
        $salesPayments = null;
    
        try {
            $this->validate();
            
            if ($this->sale_status == 1) {
                $this->suspendSale();
            }
            $totalSaleAmount = $this->getTotalAmount();
            $totalPaymentsAmount = 0;
            foreach ($this->payments as $payment) {
                $totalPaymentsAmount += $payment['payment_amount'];
            }

            // Vérifier si le montant total de la vente correspond au montant total des paiements
            if ($totalSaleAmount != $totalPaymentsAmount) {
                session()->flash('error', 'Le montant total de la vente ne correspond pas au montant total des paiements.');
                return;
            }

            $sales = Sales::create([
                'customer_id' => $this->customer_id,
                'user_id' => Auth::id(),
                'invoice_number' =>  $this->invoice_number ?? null,
                'comment' => $this->comment ?? null,
                'sale_status' => $this->sale_status,
                'location_id' => $this->location_id,
            ]);

            // Parcours des articles sélectionnés pour la vente
            foreach ($this->selectedArticles as $item) {
                // Récupération de la quantité disponible dans la location spécifiée
                $itemQuantity = ItemQuantities::where('item_id', $item['id'])
                    ->where('location_id',$this->location_id)
                    ->first();

                // Vérification de la quantité disponible
                if (!$itemQuantity || $itemQuantity->quantity < $item['quantity_purchased']) {
                    $remainingQuantity = $item['quantity_purchased'];

                    // Mise à jour de la quantité disponible dans la location spécifiée
                    if ($itemQuantity) {
                        $remainingQuantity -= $itemQuantity->quantity;
                        $itemQuantity->quantity = 0;
                        $itemQuantity->save();
                    }

                    // Recherche de quantités dans d'autres emplacements
                    $otherLocationQuantity = ItemQuantities::where('item_id', $item['id'])
                        ->where('location_id', '!=', $item['item_location'])
                        ->orderBy('quantity', 'desc')
                        ->first();

                    // Utilisation des quantités d'autres emplacements si nécessaire
                    if ($otherLocationQuantity && $remainingQuantity > 0) {
                        $quantityTakenFromOtherLocation = min($remainingQuantity, $otherLocationQuantity->quantity);
                        $otherLocationQuantity->quantity -= $quantityTakenFromOtherLocation;
                        $otherLocationQuantity->save();

                        // Récupération du nom de la localisation
                        $otherLocationName = StockLocation::find($otherLocationQuantity->location_id)->location_name;

                        $remainingQuantity -= $quantityTakenFromOtherLocation;

                        session()->flash('warning', "Quantité insuffisante pour l'article  {$item['name']} dans la location {$item['item_location']}. ". "La vente a été effectuée en prenant {$quantityTakenFromOtherLocation} unités de la location {$otherLocationName}. ");
                    }

                    // Affichage d'un avertissement si la quantité demandée est toujours insuffisante
                    if ($remainingQuantity > 0) {
                        session()->flash('warning', 'La quantité de l\'article est insuffisante');
                    }
                } else {
                    $itemQuantity->quantity -= $item['quantity_purchased'];
                    $itemQuantity->save();

                    // Création de l'enregistrement SalesItems
                    $salesItems = SalesItems::create([
                        'sale_id' => $sales->id,
                        'item_id' => $item['id'],
                        'quantity_purchased' => $item['quantity_purchased'],
                        'item_cost_price' => $item['cost_price'],
                        'item_unit_price' => $item['unit_price'],
                        'item_location' => $this->location_id,
                    ]);

                    // Vérification si la création de l'enregistrement SalesItems a réussi
                    if (!$salesItems) {
                        session()->flash('error', 'Erreur lors de la création de l\'enregistrement SalesItems.');
                    }
                }
            }

            foreach ($this->payments as $payment) {
                $salesPayments = SalesPayments::create([
                    'sale_id' => $sales->id,
                    'payment_type' => $payment['payment_type'],
                    'payment_amount' =>$payment['payment_amount'],
                    'user_id' => Auth::id(),
                    'cash_refund' => $payment['cash_refund'] ?? 0.00,
                    'cash_adjustment' => $payment['cash_adjustment'] ?? 0,
                ]);
                // Vérification si la création de l'enregistrement SalesPayments a réussi
                if (!$salesPayments) {
                    session()->flash('error', 'Erreur lors de la création de l\'enregistrement SalesPayments.');
                }
            }

            $this->reset();

            if ($sales && $salesItems && $salesPayments) {
                session()->flash('success', 'Vente créée avec succès !');
            }
        } catch (\Exception $e) {
        session()->flash('error', 'Erreur lors de la création de la vente : ' . $e->getMessage());
        
        }
    }

    
    // Méthode pour suspendre la vente
    public function suspendSale()
    {
        $this->sale_status = 1;
        session()->flash('success', 'Vente suspendue avec succès !');
    }
    public function unlockSale($saleId)
    {
        $this->edit($saleId);
        try {
            $sale = Sales::findOrFail($saleId);

            if ($this->sale_status == 0) {
                $sale->update(['sale_status' => 1]); 
            } elseif ($this->sale_status == 1) {
                $sale->update(['sale_status' => 0]); 
            }

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors du déblocage de la vente : ' . $e->getMessage());
        }
    }

    
    
    // cette methode pour calculer le total de montant à payer
    public function getTotalAmount()
    {
        $TotalPayments = 0;

        foreach ($this->selectedArticles as $article) {
            $TotalPayments += $article['unit_price'] * $article['quantity_purchased'];
        }

        return $TotalPayments;
    }


    public function edit($saleId)
    {
        $this->selectedArticles = [];
        $this->payments = [];
        $sale = Sales::findOrFail($saleId);

        $this->sale_id = $sale->id;
        $this->customer_id = $sale->customer_id;
        $this->comment = $sale->comment;
        $this->invoice_number = $sale->invoice_number;
        $this->sale_status = $sale->sale_status;
        $this->location_id = $sale->location_id;

        $salesItems = SalesItems::where('sale_id', $sale->id)->get();
        foreach ($salesItems as $item) {
            $this->selectedArticles[] = [
                'id' => $item->item_id,
                'name' => $item->item->name,
                'unit_price' => $item->item_unit_price,
                'item_location' => $item->location_id,
                'quantity_purchased' => $item->quantity_purchased,
                'cost_price' => $item->item_cost_price,
            ];
        }

        
        $salesPayments = SalesPayments::where('sale_id', $sale->id)->get();
        foreach ($salesPayments as $payment) {
            $this->payments[] = [
                'payment_type' => $payment->payment_type,
                'payment_amount' => $payment->payment_amount,
                'cash_refund' => $payment->cash_refund,
                'cash_adjustment' => $payment->cash_adjustment,
            ];
        }
    }
    public function update()
    {
        try {
            $sale = Sales::findOrFail($this->sale_id);

            $sale->update([
                'customer_id' => $this->customer_id,
                'comment' => $this->comment,
                'location_id' => $this->location_id,
            ]);

            // Mettre à jour ou créer de nouveaux articles de vente
            foreach ($this->selectedArticles as $item) {
                // Récupérer l'article de vente existant ou le créer s'il n'existe pas
                $saleItem = SalesItems::updateOrCreate(
                    ['sale_id' => $sale->id, 'item_id' => $item['id']],
                    [
                        'quantity_purchased' => $item['quantity_purchased'],
                        'item_cost_price' => $item['cost_price'],
                        'item_unit_price' => $item['unit_price'],
                        'item_location' => $this->location_id,
                    ]
                );

                $itemQuantity = ItemQuantities::where('item_id', $item['id'])
                    ->where('location_id', $this->location_id)
                    ->first();

                if ($itemQuantity) {
                    $itemQuantity->quantity -= $item['quantity_purchased'];
                    $itemQuantity->save();
                } else {
                session()->flash('error', 'la quantite est insuffisant ' );

                }
            }

            // Mettre à jour ou créer de nouveaux paiements
            foreach ($this->payments as $payment) {
                SalesPayments::updateOrCreate(
                    ['sale_id' => $sale->id, 'payment_type' => $payment['payment_type']],
                    [
                        'payment_amount' => $payment['payment_amount'],
                        'cash_refund' => $payment['cash_refund'] ?? 0.00,
                        'cash_adjustment' => $payment['cash_adjustment'] ?? 0,
                    ]
                );
            }

            session()->flash('success', 'Vente modifiée avec succès !');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la modification de la vente : ' . $e->getMessage());
        }
    }

//pour la modification on ne peut pas modifier les article de la vante j'ai 
// implementer un logique mais pas completement j'ai besoin d'ajoute le traitement de la quantite
}