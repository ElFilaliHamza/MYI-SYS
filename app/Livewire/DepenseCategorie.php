<?php

namespace App\Livewire;


use App\Models\ExpenseCategories;
use Livewire\Component;
use Livewire\WithPagination;

class DepenseCategorie extends Component
{
    use WithPagination;
    
    public $category_name;
    public $category_description;
    public $search;
    public $categories;
    public $selectedCategoryId;

    protected $rules = [
        'category_name' => 'required|string',
        'category_description' => 'nullable|string',
    ];
    public function render()
    {  
        $this->getAll();
        $categoriesData = ExpenseCategories::where('deleted', '=', 0)->paginate(3);
        return view('livewire.depense-categorie',[
            'categoriesData'=> $categoriesData,
        ]);
        
    }
    public function mount(){
        $this->getAll();
    }
    public function store(){
        if (auth()->user()->can('create Dépenses catégorie')) {
        $this->validate();
    
       $create= ExpenseCategories::create([
            'category_name' => $this->category_name,
            'category_description' => $this->category_description,
        ]);   
        if($create){
            session()->flash('success', 'Dépense catégorie crée avec succès.');
        }else{
            session()->flash('error', 'Dépense catégorie n\'est pas crée.');
        }
    }
    else {
        abort(403, 'Unauthorized');
    }
     }
    
    
     public function getAll()
     {
        if (auth()->user()->can('read Dépenses catégorie')) {
        if ($this->search) {
            $categoriesData = ExpenseCategories::where('deleted', 0)
            ->where(function ($query) {
                $query->where('category_name', 'like', '%' . $this->search . '%')
                    ->orWhere('category_description', 'like', '%' . $this->search . '%');
            })
            ->paginate(3);
        } else {
            $categoriesData = ExpenseCategories::where('deleted', 0)->paginate(3);
        }
    
        $this->categories = $categoriesData->items();
    }
    else {
        abort(403, 'Unauthorized');
    }
     }
 
    public function delete($id)
    {
        if (auth()->user()->can('delete Dépenses catégorie')) {
        $categories = ExpenseCategories::find($id);

        if (!$categories) {
            session()->flash('error', 'Le client n\'existe pas.');
        }

        $categories->update(['deleted' => 1]);
        session()->flash('success', 'Dépense catégorie supprimé avec succès.');
        $this->getAll();
    }
    else {
        abort(403, 'Unauthorized');
    }
    }
    public function edit($categoryId)
    {
        if (auth()->user()->can('update Dépenses catégorie')) {
        $category = ExpenseCategories::find($categoryId);
    
        if ($category) {
            $this->category_name = $category->category_name;
            $this->category_description = $category->category_description;
            $this->selectedCategoryId = $categoryId;
        }
    }
    else {
        abort(403, 'Unauthorized');
    }
    }
    public function update()
    {
        if (auth()->user()->can('update Dépenses catégorie')) {
        $this->validate();

        $category = ExpenseCategories::find($this->selectedCategoryId);
        if ($category) {
            $category->update([
                'category_name' => $this->category_name,
                'category_description' => $this->category_description,
            ]);
            session()->flash('success', 'La catégorie de dépenses a été mise à jour avec succès.');
            $this->reset(); 
        } else {
            session()->flash('error', 'La catégorie de dépenses n\'a pas été trouvée.');
        }
    }
    else {
        abort(403, 'Unauthorized');
    }
    }

    
}
