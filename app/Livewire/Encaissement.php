<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CashUp;
use App\Models\SalesPayments;
use App\Models\Expenses;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Encaissement extends Component
{
    public $description;
    public $open_amount_cash;
    public $closing_amount_total; 
    public $closing_amount_cash; 
    public $closing_amount_card; 
    public $closing_amount_check; 
    public $openAmountManual; 
    public $transfer_amount_cash;
    public $note;
    public $yesterdaySalesTotal;
    public $yesterdayExpensesTotal;
    public $isOpeningCaisse = null;

    public function mount()
    {
        $this->fetchYesterdayAmounts();
        $this->fetchTodayAmounts();
    }

    public function render()
    {
        return view('livewire.encaissement', [
            'open_amount_cash' => $this->open_amount_cash,
            'closed_amount_total' => $this->closing_amount_total, 
            'closed_amount_cash' => $this->closing_amount_cash, 
            'closed_amount_card' => $this->closing_amount_card, 
            'closed_amount_check' => $this->closing_amount_check, 
        ]);
    }

    public function toggleOpeningCaisse()
    {
        $this->isOpeningCaisse = true;
    }

    public function toggleClosingCaisse()
    {
        $this->isOpeningCaisse = false;
    }

    public function openCaisse()
    {
        if ($this->checkExistingOpeningRecord()) {
            session()->flash('error', 'A cash up record for today already exists.');
            return;
        }

        CashUp::create([
            'open_date' => now(),
            'open_amount_cash' => $this->open_amount_cash,
            'transfer_amount_cash' => $this->transfer_amount_cash,
            'note' => $this->note,
            'open_user_id' => Auth::id(),
            'description' => $this->description,
        ]);

        $this->resetInputFields();
        $this->isOpeningCaisse = false;

        session()->flash('success', 'Cash register opened successfully.');
    }

    private function resetInputFields()
{
    $this->description = null;
    $this->openAmountManual = null;
    $this->transfer_amount_cash = null;
    $this->note = null;
}


    public function closeCaisse()
    {
        if (!$this->checkExistingClosingRecord()) {
            session()->flash('error', 'No cash up record found for today to close.');
            return;
        }

        $latestCashUp = CashUp::latest()->first();
        $latestCashUp->update([
            'close_date' => now(),
            'closed_amount_card' => $this->closing_amount_card,
            'closed_amount_check' => $this->closing_amount_check,
            'closed_amount_cash' => $this->closing_amount_cash, 
            'closed_amount_total' => $this->closing_amount_total,
            'description' => $this->description, 
            'close_user_id' => auth()->id(),
        ]);
    }

    private function fetchYesterdayAmounts()
    {
        $this->yesterdaySalesTotal = SalesPayments::whereDate('payment_time', Carbon::yesterday())->sum('payment_amount');
        $this->yesterdayExpensesTotal = Expenses::whereDate('date', Carbon::yesterday())->sum('amount');
        $this->open_amount_cash = max(0, $this->yesterdaySalesTotal - $this->yesterdayExpensesTotal);
    }

    private function checkExistingOpeningRecord()
    {
        return CashUp::whereDate('open_date', now())->exists();
    }

    private function checkExistingClosingRecord()
    {
        return CashUp::whereDate('close_date', now())->exists();
    }

    private function fetchTodayAmounts()
{
    // Fetch total sales for today
    $totalSalesCash = SalesPayments::whereDate('payment_time', Carbon::today())
        ->where('payment_type', 'espece')
        ->sum('payment_amount');

    $totalSalesCard = SalesPayments::whereDate('payment_time', Carbon::today())
        ->where('payment_type', 'card')
        ->sum('payment_amount');

    $totalSalesCheque = SalesPayments::whereDate('payment_time', Carbon::today())
        ->where('payment_type', 'cheque')
        ->sum('payment_amount');

    // Fetch total expenses for today
    $totalExpensesCash = Expenses::whereDate('date', Carbon::today())
        ->where('payment_type', 'espece')
        ->sum('amount');

    $totalExpensesCard = Expenses::whereDate('date', Carbon::today())
        ->where('payment_type', 'card')
        ->sum('amount');

    $totalExpensesCheque = Expenses::whereDate('date', Carbon::today())
        ->where('payment_type', 'cheque')
        ->sum('amount');



    // Calculate the overall totals
    $this->closing_amount_cash = $totalSalesCash - $totalExpensesCash;
    $this->closing_amount_card = $totalSalesCard - $totalExpensesCard;
    $this->closing_amount_check = $totalSalesCheque - $totalExpensesCheque;

    // Calculate the overall total
    $this->closing_amount_total = $this->closing_amount_cash + $this->closing_amount_card + $this->closing_amount_check;
}

}