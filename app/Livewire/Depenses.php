<?php

namespace App\Livewire;

use App\Models\ExpenseCategories;
use App\Models\Expenses;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Sleep;
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

    public $date;
    public $supplier_id;

    public $expenses;
    public $search;
    
    public $selectedExpenseId;

    // Sleep(1);

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
        

        return view('livewire.depenses', [
            'expenseCategories' => ExpenseCategories::where('deleted', 0)->get(),
            'suppliers' => Supplier::where('deleted', 0)->with('people')->get(), 
            'users' => User::where('deleted', 0)->with('people')->get(),
            'expenseslist' => Expenses::where('deleted', 0)->paginate(10),
            'expenses' => $expenses,
        ]);
    }
    // public function mount(){
    //     $this->expense_category_id = ExpenseCategories::where('deleted', '=', 0)->get();
    //     $this->supplier_id = Supplier::where('deleted', '=', 0)->get();
    // }
    
    public function store(){
        if (auth()->user()->can('create Dépenses')) {
        $this->validate();
        // for ($i=0; $i < 30; $i++) { 

        Expenses::create([
            'amount' => $this->amount,
            'payment_type' => $this->payment_type,
            'expense_category_id' => $this->expense_category_id,
            'description' => $this->description,
            'user_id' => $this->user_id, 
            'supplier_id' => $this->supplier_id,
        ]);
    // }
        session()->flash('success', 'Dépense crée avec succès.');
    }
    else {
        abort(403, 'Unauthorized');
    } 

    }
    public function delete($id){
        if (auth()->user()->can('delete Dépenses')) {
        $expense = Expenses::find($id);
    
        if (!$expense) {
            session()->flash('error', 'L\'article n\'existe pas.');
        }
    
        $expense->update(['deleted' => 1]);
             session()->flash('successDelete', 'Article supprimé avec succès.');
             $this->index();
            }
            else {
                abort(403, 'Unauthorized');
            } 
    }
    public function index()
    {
        if (auth()->user()->can('read Dépenses')) {
        if ($this->search) {
            $expensesData = Expenses::where('deleted','=', 0)
                ->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                  ->orWhere('payment_type', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('date', 'like', '%' . $this->search . '%')
                  ->whereHas('supplier', function ($query) {
                        $query->where('deleted', '=', 0)
                            ->whereHas('people', function ($query) {
                                $query->where('first_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->orWhereHas('user', function ($query) {
                        $query->where('deleted', '=', 0)
                            ->whereHas('people', function ($query) {
                                $query->where('first_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->orWhereHas('expenseCategory', function ($query) {
                        $query->where('deleted', '=', 0)
                            ->where('category_name', 'like', '%' . $this->search . '%');
                    });
                })
                ->with('supplier.people', 'expenseCategory', 'user.people')
                ->paginate(10);
        } else {
            $expensesData = Expenses::where('deleted','=', 0)
                ->with('supplier.people', 'expenseCategory', 'user.people')
                ->paginate(10);
        }
    
        $this->expenses = $expensesData->items();
        
        return $expensesData;
    }
    else {
        abort(403, 'Unauthorized');
    }
    }
    public function edit($id)
{
    
    if (auth()->user()->can('update Dépenses')) {
    $expense = Expenses::findOrFail($id);

    $this->selectedExpenseId = $expense->id;
    $this->amount = $expense->amount;
    $this->payment_type = $expense->payment_type;
    $this->expense_category_id = $expense->expense_category_id;
    $this->description = $expense->description;
    $this->user_id = $expense->user_id;
    $this->date = $expense->date;

    $this->supplier_id = $expense->supplier_id;
}
else {
    abort(403, 'Unauthorized');
}
}


public function update()
{
    if (auth()->user()->can('update Dépenses')) {
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
    else {
        abort(403, 'Unauthorized');
    }
}
  
}
