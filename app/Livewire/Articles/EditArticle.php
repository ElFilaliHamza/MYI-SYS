<?php

namespace App\Livewire\Articles;

use App\Models\Items;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditArticle extends Component
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
        return view('livewire.articles.edit-article');
    }

    public function mount($item_id)
    {
        $item = Items::findOrFail($item_id);
        $this->edit($item_id);
    }
    public function edit($item_id)
    {
        if (auth()->user()->can('update Articles')) {
        // dd('tes');
        $item = Items::findOrFail($item_id);
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
    else {
        abort(403, 'Unauthorized');
    }
    }
    public function update()
    {
        if (auth()->user()->can('update Articles')) {
        $this->validate();
    
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
        
        return redirect()->to('/articles' );
    } 
    else {
        abort(403, 'Unauthorized');
    }
        
    }
}
