<?php

namespace App\Livewire;

use App\Models\ItemQuantities;
use App\Models\Items;
use App\Models\Receivings;
use App\Models\ReceivingsItem;
use App\Models\ItemQuantity;
use App\Models\PaymentType;
use App\Models\StockLocation;
use App\Models\Supplier;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StockEntry extends Component
{
    public $receiving_type = 'reception';
    public $stock_source;
    public $stock_destination;
    public $total = 0;
    public $comment = '';
    public $reference = '';
    public $payment_type = 'Espèce';
    public $montant_presente;
    public $selectedItems = [];
    public $items;
    public $selectedItemId;
    public $selectedItem;
    public $locations;
    public $payments = [];
    public $suppliers;
    public $supplier_id;

    public function mount()
    {
        $this->items = Items::where('deleted', 0)->get();
        $this->locations = StockLocation::where('deleted', 0)->get();
        $this->suppliers = Supplier::where('deleted', 0)->with('people')->get();
    }

    public function render()
    {
        return view('livewire.stock-entry');
    }

    public function displaySelectedItem()
    {
        $test = array_filter($this->selectedItems, function ($item) {
            return $item['item']->id == $this->selectedItemId;
        });

        if ($this->selectedItemId && !$test) {
            $this->selectedItem = Items::find($this->selectedItemId);
            $this->selectedItems[] = [
                'item' => $this->selectedItem,
                'total' => $this->selectedItem->cost_price,
                'quantity' => 1,
            ];

            $this->total += $this->selectedItem->cost_price;
        }
    }

    public function showPayment()
    {
        if ($this->montant_presente > $this->total) {
            return;
        }
        if ($this->montant_presente != 0 && !$this->checkPayment()) {
            $this->payments[] = [
                'montant_presente' => $this->montant_presente,
                'payment_type' => $this->payment_type,
            ];
        } else {
            for ($i = 0; $i < count($this->payments); $i++) {
                if ($this->payments[$i]['payment_type'] == $this->payment_type) {
                    $this->payments[$i]['montant_presente'] += $this->montant_presente;
                }
            }
        }
        $this->total -= $this->montant_presente;
        $this->payment_type = 'Espèce';
        $this->montant_presente = 0;
    }

    public function checkPayment()
    {
        foreach ($this->payments as $payment) {
            if ($payment['payment_type'] == $this->payment_type) {
                return true;
            }
        }
        return false;
    }

    public function updateTotal($qnt, $itemId)
    {
        // $this->total = $this->selectedItem->cost_price * $qnt;
        for ($i = 0; $i < count($this->selectedItems); $i++) {
            if ($this->selectedItems[$i]['item']->id == $itemId) {
                $this->selectedItems[$i]['quantity'] = $qnt;
                $this->selectedItems[$i]['total'] = $this->selectedItems[$i]['item']->cost_price * $qnt;
                $this->total = 0;
                foreach ($this->selectedItems as $currentItem) {
                    $this->total += $currentItem['total'];
                }
                $this->total -= $this->getTotalPayments();
            }
        }
    }

    public function getTotalPayments()
    {
        $totalPayments = 0;
        foreach ($this->payments as $payment) {
            $totalPayments += $payment['montant_presente'];
        }
        return $totalPayments;
    }

    public function validateOperation()
    {
        $receiving_time = Carbon::now()->format('Y-m-d H:i:s');
        // Insert data into the 'receivings' table
        $receiving = Receivings::create([
            'receiving_time' => $receiving_time,
            'user_id' => Auth::id(),
            'supplier_id' => $this->supplier_id,
            'comment' => $this->comment,
            'payment_type' => $this->payment_type,
            'reference' => $this->reference,
            'receiving_type' => $this->receiving_type,
            'stock_source' => $this->stock_source,
            'stock_destination' => $this->stock_destination,
        ]);
        // dd($this->selectedItems);

        // Insert data into the 'receivings_items' table for each selected item
        foreach ($this->selectedItems as $selectedItem) {
            // Create a record in 'receivings_items' table
            ReceivingsItem::create([
                'item_id' => $selectedItem['item']->id,
                'receiving_id' => $receiving->id,
                'description' => $selectedItem['item']->description,
                'quantity_purchased' => $selectedItem['quantity'],
                'serialnumber' => $selectedItem['item']->item_number,
                'item_cost_price' => $selectedItem['item']->cost_price,
                'item_unit_price' => $selectedItem['item']->unit_price,
                'item_location' => $this->stock_source,
                'receiving_quantity' => $selectedItem['quantity'],
            ]);

            // If it's a requisition, handle the transfer of items between stocks
            if ($this->receiving_type === 'requisition') {
                // Update the quantity in the source stock (Stock B)
                $sourceItemQuantity = ItemQuantities::where('item_id', $selectedItem['item']->id)
                    ->where('location_id', $this->stock_source)
                    ->first();

                if ($sourceItemQuantity) {
                    // Subtract the transferred quantity from the source stock
                    $sourceItemQuantity->quantity -= $selectedItem['quantity'];

                    // Ensure the quantity doesn't go negative
                    if ($sourceItemQuantity->quantity < 0) {
                        $sourceItemQuantity->quantity = 0;
                    }

                    // Save the updated quantity
                    $sourceItemQuantity->save();

                    // If the quantity in the source stock becomes zero, delete the record
                    if ($sourceItemQuantity->quantity == 0) {
                        $sourceItemQuantity->delete();
                    }
                }

                // Update the quantity in the destination stock (Stock A)
                $destinationItemQuantity = ItemQuantities::where('item_id', $selectedItem['item']->id)
                    ->where('location_id', $this->stock_destination)
                    ->first();

                if ($destinationItemQuantity) {
                    // Add the transferred quantity to the destination stock
                    $destinationItemQuantity->quantity += $selectedItem['quantity'];
                    $destinationItemQuantity->save();
                } else {
                    // If the item doesn't exist in the destination stock, create a new record
                    ItemQuantities::create([
                        'item_id' => $selectedItem['item']->id,
                        'location_id' => $this->stock_destination,
                        'quantity' => $selectedItem['quantity'],
                    ]);
                }
            }
            // If it's a reception
            if ($this->receiving_type === 'reception' || $this->receiving_type === 'retour') {
                // Update the quantity in the destination stock (Stock A)
                foreach ($this->selectedItems as $selectedItem) {
                    $destinationItemQuantity = ItemQuantities::where('item_id', $selectedItem['item']->id)
                        ->where('location_id', $this->stock_source)
                        ->first();

                    if ($destinationItemQuantity) {
                        // Add the received quantity to the destination stock
                        $destinationItemQuantity->quantity += $selectedItem['quantity'];
                        $destinationItemQuantity->save();
                    } else {
                        // If the item doesn't exist in the destination stock, create a new record
                        ItemQuantities::create([
                            'item_id' => $selectedItem['item']->id,
                            'location_id' => $this->stock_source,
                            'quantity' => $selectedItem['quantity'],
                        ]);
                    }
                }
            }
        }

        // Ensure montant_presente is equal to or less than total
        foreach ($this->payments as $payment) {
            PaymentType::create([
                'payment_type' => $payment['payment_type'],
                'payment_amount' => $payment['montant_presente'],
                'receivings_id' => $receiving->id,
            ]);
        }

        // Reset form fields
        // $this->resetForm();
        // return;
    }

    public function cancelOperation()
    {
        // Reset form fields
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->receiving_type = 'reception';
        $this->stock_source = '';
        $this->stock_destination = '';
        $this->selectedItemId = null;
        $this->selectedItem = null;
        $this->total = 0;
        $this->comment = '';
        $this->reference = '';
        $this->payment_type = 'Espèce';
        $this->montant_presente = 0;
    }
}