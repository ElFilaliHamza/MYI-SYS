<?php

namespace App\Livewire;

use App\Models\Inventory;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class Articles extends Component
{
    use WithFileUploads;
    use WithPagination;

    
    #[Validate]
    public $name,$category , $item_number , $description , $cost_price , $unit_price , $stock_type , $item_type;
    
    public $pic_filename;
    public $items;
    public $selectedItemId;

    public $search;
    public $nameEdit;
    public $categoryEdit;
    public $item_numberEdit;
    public $descriptionEdit;
    public $cost_priceEdit;
    public $unit_priceEdit;
    public $pic_filenameEdit;
    public $item_typeEdit;
    public $stock_typeEdit;

  
    
    public function render()
    {
        $items = $this->getAll();
        return view('livewire.articles', [
            'items' => $items,
            'ArticlesList'=>Items::where('deleted', 0)->paginate(2)

        ]);
    }
   

    public function getAll()
    {
        if ($this->search) {
            $itemsData = Items::where('deleted', '=', 0)
                ->where(function ($query) {
                    $query->whereAny(['name',
                    'id',
                    'category',
                    'description','item_number',
                    'cost_price','unit_price',
                    'item_type'], 'like', '%'. $this->search . '%');
                        
                })
                ->paginate(10);

            // $itemsData = Items::where('deleted', '=', 0)
            //     ->where(function ($query) {
            //         $query->whereIn(  $this->search , ['name',
            //         'id',
            //         'category',
            //         'description','item_number',
            //         'cost_price','unit_price',
            //         'item_type']);
                        
            //     })
            //     ->paginate(10);
        } else {
            $itemsData = Items::where('deleted', '=', 0)->paginate(20);
        }
        $this->items = $itemsData->items();
    }


    public function store()
    {
        $this->validate();
        if ($this->pic_filename === null) {
            $item = Items::create([
                'name' => $this->name,
                'category' => $this->category,
                'item_number' => $this->item_number,
                'description' => $this->description,
                'cost_price' => $this->cost_price,
                'unit_price' => $this->unit_price,
                'item_type' => $this->item_type,
                'stock_type' => $this->stock_type,
            ]);
        } else {
            $item = Items::create([
                'name' => $this->name,
                'category' => $this->category,
                'item_number' => $this->item_number,
                'description' => $this->description,
                'cost_price' => $this->cost_price,
                'unit_price' => $this->unit_price,
                'pic_filename' => $this->pic_filename->getClientOriginalName(),
                'item_type' => $this->item_type,
                'stock_type' => $this->stock_type,
            ]);
        }

        if ($item->stock_type === 'inventaire') {
            Inventory::create([
                'trans_items' => $item->id,
                'trans_user_id' => Auth::user()->id,
                'trans_date' => now(),
            ]);
        }
        $this->resetFields();
    
    }




    public function destroy($item_id)
    {
        $Items = Items::find($item_id);

        if (!$Items) {
            session()->flash('error', 'L\'article n\'existe pas.');
        }

        $Items->update(['deleted' => 1]);
        session()->flash('success', 'Article supprimé avec succès.');
        $this->getAll();
    }


    public function edit($item_id)
    {
        $item = Items::find($item_id);
        if ($item) {
            $this->name = $item->name;
            $this->category = $item->category;
            $this->item_number = $item->item_number;
            $this->description = $item->description;
            $this->cost_price = $item->cost_price;
            $this->unit_price = $item->unit_price;
            $this->pic_filename = $item->pic_filename;
            $this->item_type = $item->item_type;
            $this->stock_type = $item->stock_type;
            $this->selectedItemId = $item_id;
        }
    }
    public function messages(){
        return [
            'name.required' => 'Ce champs est obligatoire',
            'category.required' => 'Ce champs est obligatoire',
            'item_number.required' => 'Ce champs est obligatoire',
            'description.required' => 'Ce champs est obligatoire',
            'cost_price.required' => 'Ce champs est obligatoire',
            'cost_price.numeric' => "Ce champs n'accepte que des nombres",
            'unit_price.required' => 'Ce champs est obligatoire',
            'item_type.required' => 'Ce champs est obligatoire',
            'stock_type.required' => 'Ce champs est obligatoire',
        ];
    }
    public function rules(){
        return [
            'name' => 'required|string',
            'category' => 'required|string',
            'item_number' => 'required|string',
            'description' => 'required|string',
            'cost_price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'item_type' => 'required|string',
            'stock_type' => 'required|string',
        ];
    }

    public function updateArticle()
    {
        // $this->validate();
        $item = Items::find($this->selectedItemId);
        if ($item) {
            $item->update([
                'name' => $this->name,
                'category' => $this->category,
                'item_number' => $this->item_number,
                'description' => $this->description,
                'cost_price' => $this->cost_price,
                'unit_price' => $this->unit_price,
                'pic_filename' =>  $this->pic_filename,
                'item_type' => $this->item_type,
                'stock_type' => $this->stock_type,
            ]);
            if ($item->stock_type === 'inventaire') {
                Inventory::create([
                    'trans_items' => $item->id,
                    'trans_user_id' => Auth::user()->id,
                    'trans_date' => now(),
                ]);
            }
            session()->flash('success', 'L\'élément a été mis à jour avec succès.');
        } else {
            session()->flash('error', 'L\'élément n\'a pas été trouvé.');
        }
    }

    
    
    private function resetFields()
    {
        $this->name = '';
        $this->category = '';
        $this->item_number = '';
        $this->description = '';
        $this->cost_price = '';
        $this->unit_price = '';
    }
}