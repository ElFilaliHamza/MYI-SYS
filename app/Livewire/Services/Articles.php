<?php

namespace App\Livewire\Services;

use App\Models\Items;
use Livewire\Component;
use Livewire\WithFileUploads;


class Articles extends Component
{
    use WithFileUploads;

    public $name;
    public $category;
    public $item_number;
    public $description;
    public $cost_price;
    public $unit_price;
    public $pic_filename;
    public $item_type;
    public $items;
    public $selectedItemId;
    

    protected $rules = [
        'name' => 'required|string',
        'category' => 'required|string',
        'item_number' => 'required|string',
        'description' => 'required|string',
        'cost_price' => 'required|numeric',
        'unit_price' => 'required|numeric',
        'item_type' => 'nullable|string',
    ];
    public function render()
    {
        $this->getAll();
        return view('livewire.services.articles');
    }
    public function mount(){
        $this->getAll();
    }
    public function validateField($field)
    {
        $this->validateOnly($field);
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'item_number' => 'required|numeric',
            'description' => 'required|string',
            'cost_price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'pic_filename' => 'image|max:1024',
            'item_type' => 'required|boolean',
        ]);
        Items::create([
            'name' => $this->name,
            'category' => $this->category,
            'item_number' => $this->item_number,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'unit_price' => $this->unit_price,
            'pic_filename' => $this->pic_filename->getClientOriginalName(), 
            'item_type'=> $this->item_type,

        ]);
    
        $this->reset();
        $this->getAll();
    }
    

    
    public function destroy($item_id){
        $Items = Items::find($item_id);
    
        if (!$Items) {
            session()->flash('error', 'L\'article n\'existe pas.');
        }
    
        $Items->update(['deleted' => 1]);
             session()->flash('success', 'Article supprimé avec succès.');
             $this->getAll();
        
    }
    
    public function getAll(){
        $this->items = Items::where('deleted', '=', 0)->get();
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
            $this->selectedItemId = $item_id;
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'item_number' => 'required|string',
            'description' => 'required|string',
            'cost_price' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'item_type' => 'required|numeric',
        ]);
    
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
            ]);
            session()->flash('success', 'L\'élément a été mis à jour avec succès.');
            $this->reset(); 
        } else {
            session()->flash('error', 'L\'élément n\'a pas été trouvé.');
        }
    }
   

    
}
