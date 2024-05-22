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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Ventes extends Component
{
    public $customer_id;
    public $comment;
    public $invoice_number;
    public $sale_status;
    public $user_id;
    public $item_id;
    public $quantity_purchased;
    public $item_cost_price;
    public $item_unit_price;
    public $item_location;
    public $items;
    public $customers;
    public $selectedArticles = [];
    public $payments = [];
    public $payment_type;
    public $payment_amount;
    public $cash_refund;
    public $cash_adjustment;
    public $sales;
    public $sale_id;

    protected $rules = [
        'customer_id' => 'required|integer',
        'comment' => 'nullable|string|max:255',
        'item_id' => 'required|integer',
        'quantity_purchased' => 'required|numeric|min:1',
        'payment_type' => 'required|string',
        'payment_amount' => 'required|numeric',
    ];

    public function render()
    {
        $this->loadItems();
        $this->loadCustomers();
        $this->loadStockLocations();
        $this->generateInvoiceNumber();
        $this->quantity_purchased = 1;
        $this->payment_amount = $this->getTotalAmount();

        return view('livewire.services.ventes', [
            'customers' => $this->customers,
            'items' => $this->items,
            'item_locations' => $this->item_location,
        ]);
    }

    private function loadItems()
    {
        $this->items = Items::where('deleted', 0)->join('item_quantities', 'items.id', '=', 'item_quantities.item_id')->select('items.*')->distinct()->get();
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
        $this->invoice_number = 'INV' . Carbon::now()->format('Ymd') . '-' . str_pad(Sales::count() + 1, 4, '0', STR_PAD_LEFT);
    }
    public $showSuspendedSales = false;

    public function index()
    {
        $this->showSuspendedSales = !$this->showSuspendedSales;
        $this->sales = Sales::where('sale_status', 1)->get();
    }

    public function addPayment()
    {
        $isExist = false;
        foreach ($this->payments as $payment) {
            if ($payment['payment_type'] == $this->payment_type) {
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

    public function loadArticleDetails()
    {
        if (!empty($this->item_id)) {
            $articleDetails = Items::findOrFail($this->item_id);
            $this->selectedArticles[] = [
                'id' => $articleDetails->id,
                'name' => $articleDetails->name,
                'unit_price' => $articleDetails->unit_price,
                'item_location' => $articleDetails->item_location,
                'quantity_purchased' => $articleDetails->quantity_purchased,
                'cost_price' => $articleDetails->cost_price,
            ];
            $this->emptyPaymentsFields();
        }
    }

    private function emptyPaymentsFields()
    {
        $this->payment_type = '';
        $this->payment_amount = '';
        $this->cash_refund = '';
        $this->cash_adjustment = '';
    }

    // Méthode pour créer une vente complète
    public function store()
    {
        $salesItem = null;
        $sales_payment = null;

        try {
            $this->validate();
            if ($this->sale_status == 1) {
                $this->suspendSale();
            }
            $sales = Sales::create([
                'customer_id' => $this->customer_id,
                'user_id' => Auth::id(),
                'invoice_number' => $this->invoice_number,
                'comment' => $this->comment ?? null,
                'sale_status' => $this->sale_status,
            ]);

            // Parcours des articles sélectionnés pour la vente
            foreach ($this->selectedArticles as $item) {
                // Récupération de la quantité disponible dans la location spécifiée
                $itemQuantity = ItemQuantities::where('item_id', $item['id'])
                    ->where('location_id', $item['item_location'])
                    ->first();

                // Vérification de la quantité disponible
                if (!$itemQuantity || $itemQuantity->quantity < $item['quantity_purchased']) {
                    // Initialisation de la quantité restante à trouver
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

                        $remainingQuantity -= $quantityTakenFromOtherLocation;

                        // Affichage d'un avertissement sur l'utilisation de quantités d'autres emplacements
                        session()->flash('warning', "Quantité insuffisante pour l'article ID {$item['id']} dans la location {$item['item_location']}. ");
                        session()->flash('warning', "La vente a été effectuée en prenant {$quantityTakenFromOtherLocation} unités de la location {$otherLocationQuantity->location_id}. ");
                    }

                    // Affichage d'un avertissement si la quantité demandée est toujours insuffisante
                    if ($remainingQuantity > 0) {
                        session()->flash('warning', 'La quantité de l\'article est insuffisante');
                    }
                } else {
                    // Déduction de la quantité disponible dans la location spécifiée
                    $itemQuantity->quantity -= $item['quantity_purchased'];
                    $itemQuantity->save();

                    // Création d'une ligne d'élément de vente
                    try {
                        $salesItem = SalesItems::create([
                            'sale_id' => $sales->id,
                            'item_id' => $item['id'],
                            'quantity_purchased' => $item['quantity_purchased'],
                            'item_cost_price' => $item['cost_price'],
                            'item_unit_price' => $item['unit_price'],
                            'item_location' => $item['item_location'],
                        ]);
                    } catch (\Exception $e) {
                        session()->flash('error', 'Erreur lors de la création des détails de l\'article vendu : ' . $e->getMessage());
                    }
                }
            }

            foreach ($this->payments as $payment) {
                $sales_payment = SalesPayments::create([
                    'sale_id' => $sales->id,
                    'payment_type' => $payment['payment_type'],
                    'payment_amount' => $this->payment_amount,
                    'user_id' => Auth::id(),
                    'cash_refund' => $payment['cash_refund'] ?? 0.0,
                    'cash_adjustment' => $payment['cash_adjustment'] ?? 0,
                ]);
            }

            $this->reset();

            if ($sales && $salesItem && $sales_payment) {
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
        $sale = Sales::findOrFail($saleId);
        $sale->update(['sale_status' => 0]);
        session()->flash('success', 'Vente débloquée avec succès !');
    }

    // cette methode pour calculer le total de montant à payer
    public function getTotalAmount()
    {
        $payment_amount = 0;

        foreach ($this->selectedArticles as $article) {
            $payment_amount += $article['unit_price'] * $article['quantity_purchased'];
        }

        return $payment_amount;
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
    public function validateField($field)
    {
        $this->validateOnly($field);
    }
}
