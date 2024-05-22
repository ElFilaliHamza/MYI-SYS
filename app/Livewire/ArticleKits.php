<?php
namespace App\Livewire;

use App\Models\ItemKitItems;
use App\Models\ItemKits;
use App\Models\Items;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleKits extends Component
{
    use WithPagination;
    public $item_kit_number;
    public $name;
    public $item_id;
    public $kit_discount;
    public $kit_discount_type;
    public $price_option;
    public $print_option;
    public $description;

    public $items;
    public $selectedArticles = [];
    public $quantity;
    public $kit_sequence;
    public $item_kits;
    public $search;
    public $selectitemkitId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'kit_discount' => 'nullable|numeric',
        'kit_discount_type' => 'nullable|string',
        'price_option' => 'nullable|string',
        'print_option' => 'nullable|string',
        'description' => 'nullable|string',
        'quantity'=>'nullable|integer',
        'kit_sequence' => 'nullable|integer'
    ];
    
    public function render()
    {   
        $this->index();
        return view('livewire.article-kits',[
            'itemKitsData' => Itemkits::paginate(1),
        ]); 
    }

    public function mount(){
        $this->items = Items::where('deleted', '=', 0)->get();
    }
    
    public function store(){
        // dd('ee');
        $this->validate();

        $itemKit =ItemKits::create([
            'item_kit_number' => $this->item_kit_number,
            'name' => $this->name,
            'kit_discount' => $this->kit_discount,
            'kit_discount_type' => $this->kit_discount_type,
            'price_option' => $this->price_option,
            'print_option' => $this->print_option,
            'description' => $this->description,
        ]);
        
        if (!empty($this->selectedArticles)) {
            foreach ($this->selectedArticles as $selected) {
                ItemKitItems::create([
                    'item_kit_id' => $itemKit->id,
                    'item_id' => $selected['id'],
                    'quantity' =>$selected['quantity'],
                    'kit_sequence' => $selected['kit_sequence'],
                ]);
            }
        }
        $this->index();
    }

    public function addArticle() {
        $item = Items::find($this->item_id);
        if ($item) {
            $existingArticle = collect($this->selectedArticles)->firstWhere('id', $item->id);
            
            if (!$existingArticle) {
                $this->selectedArticles[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $this->quantity, 
                    'kit_sequence'=> $this->kit_sequence,
                ];
            } else {
                
                session()->flash('error', 'Cet article est déjà ajouté. Augmenter la quantite');
            }
        }
    }
    
    public function removeArticle($index) {
        if (array_key_exists($index, $this->selectedArticles)) {
            unset($this->selectedArticles[$index]);
        }
    }
    
    public function index(){
        if ($this->search) {
            $item_kitsData = ItemKits::where('name', 'like', '%' . $this->search . '%')
                                ->orwhere('id', 'like', '%' . $this->search . '%')
                                ->orWhere('item_kit_number', 'like', '%' . $this->search . '%')
                                ->orwhere('kit_discount', 'like', '%' . $this->search . '%')
                                ->orWhere('kit_discount_type', 'like', '%' . $this->search . '%')
                                ->orWhere('price_option', 'like', '%' . $this->search . '%')
                                ->orWhere('print_option', 'like', '%' . $this->search . '%')
                                ->orWhere('description', 'like', '%' . $this->search . '%')
                                ->paginate(1);
        } else {
            $item_kitsData = ItemKits::paginate(1);
        }
        $this->item_kits = $item_kitsData->items();
    }

    public function delete($itemKitId)
    {
        ItemKitItems::where('item_kit_id', $itemKitId)->delete();
        ItemKits::find($itemKitId)->delete();
        $this->index();
    }

    public function edit($itemKitId)
    {
        $itemKit = ItemKits::findOrFail($itemKitId);

        $this->item_kit_number = $itemKit->item_kit_number;
        $this->name = $itemKit->name;
        $this->kit_discount = $itemKit->kit_discount;
        $this->kit_discount_type = $itemKit->kit_discount_type;
        $this->price_option = $itemKit->price_option;
        $this->print_option = $itemKit->print_option;
        $this->description = $itemKit->description;
        $this->selectitemkitId = $itemKitId;

        $this->selectedArticles = [];
        $itemKitItems = ItemKitItems::where('item_kit_id', $itemKitId)->get();
        foreach ($itemKitItems as $itemKitItem) {
            $item = Items::find($itemKitItem->item_id);
            if ($item) {
                $this->selectedArticles[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $itemKitItem->quantity,
                    'kit_sequence'=> $itemKitItem->kit_sequence, 
                ];
            }
        }
    }

    public function update()
    {
        $this->validate();
        $itemKit = ItemKits::findOrFail($this->selectitemkitId);

        $itemKit->update([
            'item_kit_number' => $this->item_kit_number,
            'name' => $this->name,
            'kit_discount' => $this->kit_discount,
            'kit_discount_type' => $this->kit_discount_type,
            'price_option' => $this->price_option,
            'print_option' => $this->print_option,
            'description' => $this->description,
        ]);

        $selectedItemIds = collect($this->selectedArticles)->pluck('id')->toArray();
        ItemKitItems::where('item_kit_id', $this->selectitemkitId)
                    ->whereNotIn('item_id', $selectedItemIds)
                    ->delete();

        foreach ($this->selectedArticles as $selected) {
            $existingItemKitItem = ItemKitItems::where('item_kit_id', $this->selectitemkitId)
                                                ->where('item_id', $selected['id'])
                                                ->first();
            if ($existingItemKitItem) {
                $existingItemKitItem->update([
                    'quantity' => $selected['quantity'],
                    'kit_sequence' => $selected['kit_sequence'],
                ]);
            } else {
                ItemKitItems::create([
                    'item_kit_id' => $this->selectitemkitId,
                    'item_id' => $selected['id'],
                    'quantity' => $selected['quantity'],
                    'kit_sequence' => $selected['kit_sequence'],
                ]);
            }
        }
        $this->index();
        $this->reset();
    }

    
    public function calculateRetailPrice($itemKitId)
    {
        $itemKitItems = ItemKitItems::where('item_kit_id', $itemKitId)->get();
        $retailPrice = 0;
    
        foreach ($itemKitItems as $itemKitItem) {
            $item = Items::find($itemKitItem->item_id);
            if ($item) {
                $retailPrice += $item->unit_price * $itemKitItem->quantity;
            }
        }
    
        $retailPrice -= ($retailPrice * $this->kit_discount / 100);
    
        return $retailPrice;
    }
    
    public function calculateWholesalePrice($itemKitId)
    {
        $retailPrice = $this->calculateRetailPrice($itemKitId);
    
        $wholesalePrice = $retailPrice * 1.2;
    
        return $wholesalePrice;
    }

    public function generateBarcode($itemKitId)
    {
        // Récupérer le numéro de kit d'article et le prix de détail du groupe d'articles
        $itemKit = ItemKits::findOrFail($itemKitId);
        $itemKitNumber = $itemKit->item_kit_number;
        $retailPrice = $this->calculateRetailPrice($itemKitId);
    
        // Formater le texte avec le nom en haut et le prix en bas
        $barcodeText = "{ $itemKitNumber}";
    
        // Encoder le texte pour l'URL
        $encodedBarcodeText = urlencode($barcodeText);
    
        // Construire l'URL du code-barres en utilisant le texte formaté et les paramètres appropriés
        $barcodeUrl = "https://barcode.tec-it.com/barcode.ashx?data={$encodedBarcodeText}&code=Code128&multiplebarcodes=false&translate-esc=false";
    
        // Rediriger vers l'URL du code-barres généré
        return redirect()->to($barcodeUrl);
    }
    
}
