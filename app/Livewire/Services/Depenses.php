<?php

namespace App\Livewire\Services;

use App\Models\ExpenseCategories;
use App\Models\Expenses;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Depenses extends Component
{
    use WithPagination;
    public $amount;
    public $payment_type;
    public $expense_category_id;
    public $description;
    public $user_id;
    public $supplier_id;

    public $expenses;
    public $search;
    
    public $selectedExpenseId;

       



    protected $rules = [
        'amount' => 'required|numeric',
        'payment_type' => 'required|string|max:40',
        'expense_category_id' => 'required|exists:expense_categories,id',
        'description' => 'required|string|max:255',
        'supplier_id' => 'nullable|exists:supplier,id',
    ];
    public function render()
    {
        $expenses = $this->index();
        return view('livewire.services.depenses', [
            'expenseCategories' => ExpenseCategories::where('deleted', 0)->get(),
            'suppliers' => Supplier::where('deleted', 0)->with('people')->get(), 
            'users' => User::where('deleted', 0)->with('people')->get(),
            'expenses' => $expenses,
        ]);
    }
    // public function mount(){
    //     $this->expense_category_id = ExpenseCategories::where('deleted', '=', 0)->get();
    //     $this->supplier_id = Supplier::where('deleted', '=', 0)->get();
    // }
    
    public function store(){
        $this->validate();

        Expenses::create([
            'amount' => $this->amount,
            'payment_type' => $this->payment_type,
            'expense_category_id' => $this->expense_category_id,
            'description' => $this->description,
            'user_id' => $this->user_id, 
            'supplier_id' => $this->supplier_id,
        ]);
        session()->flash('success', 'Dépense crée avec succès.');
        

    }
    public function delete($id){
        $expense = Expenses::find($id);
    
        if (!$expense) {
            session()->flash('error', 'L\'article n\'existe pas.');
        }
    
        $expense->update(['deleted' => 1]);
             session()->flash('success', 'Article supprimé avec succès.');
             $this->index();
        
    }
    public function index()
    {
       
            if ($this->search) {
                $expensesData = Expenses::where('deleted', 0)
                ->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                        ->orWhere('payment_type', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');

                })
                ->with('supplier.people', 'expenseCategory', 'user.people')
                ->paginate(1);
            } else {
                $expensesData = Expenses::where('deleted', 0)
                ->with('supplier.people', 'expenseCategory', 'user.people')
                ->paginate(1);
            }
        
            $this->expenses = $expensesData->items();
         
    }
    public function edit($id)
{
    $expense = Expenses::findOrFail($id);

    $this->selectedExpenseId = $expense->id;
    $this->amount = $expense->amount;
    $this->payment_type = $expense->payment_type;
    $this->expense_category_id = $expense->expense_category_id;
    $this->description = $expense->description;
    $this->user_id = $expense->user_id;
    $this->supplier_id = $expense->supplier_id;
}


public function update()
{
    $this->validate();

    $expense = Expenses::findOrFail($this->selectedExpenseId);

    $expense->update([
        'amount' => $this->amount,
        'payment_type' => $this->payment_type,
        'expense_category_id' => $this->expense_category_id,
        'description' => $this->description,
        'user_id' => $this->user_id,
        'supplier_id' => $this->supplier_id,
    ]);

  
    session()->flash('success', 'Dépense mise à jour avec succès.');
}

    
}
