<?php

namespace App\Livewire;

use App\Models\Customers;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Component;
use App\Models\SalesItems;
use App\Models\SalesPayments;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ItemQuantities;

class Dashboard extends Component
{
    public $totalUniqueItems;
    public $cashupUser;
    public $itemQuantities;
    public $cashup;
    public $customers;
    public $suppliers;
    public $users;
    public $numberOfCustomers;
    public $numberOfSuppliers;
    public $numberOfUsers;
    public $showSuspendedSales = false;
    public $salesSuspendue;
    public $salesComplete;
    public $generaFacture;

    public $selectedSalesId;
    public $TotalPayments;
    public $dompdf;
    public $viewName = 'livewire.invoice-pdf';
    public $usersOpened;
    public $usersClosed;
    public function render()
    {
        return view('livewire.dashboard', [
            'usersOpened' => $this->usersOpened,
            'usersClosed' => $this->usersClosed,
        ]);
    }
    public function mount()
    {
        $this->loadCustomers();
        $this->loadSupplier();
        $this->loadUser();
        $this->showSaleComplete();
        $this->showSaleSuspendre();
        $this->loadUsersWhoOpenedCashUp();
        $this->loadUsersWhoClosedCashUp();
        $this->loadItemQuantities();
        $this->totalUniqueItems = $this->countUniqueItems();
    }
    private function countUniqueItems()
    {
        return DB::table('item_quantities')->distinct()->count('item_id');
    }
    private function loadItemQuantities()
    {
        $this->itemQuantities = ItemQuantities::with(['item', 'location'])->get();
    }
    public function loadUsersWhoOpenedCashUp()
    {
        $today = Carbon::today();
        $this->usersOpened = DB::table('cash_up')
            ->whereDate('open_date', $today)
            ->leftJoin('users', 'cash_up.open_user_id', '=', 'users.id')
            ->select('users.*', DB::raw('DATE_FORMAT(cash_up.open_date, "%h:%i %p") as formatted_open_date'))
            ->get();
    }

    public function loadUsersWhoClosedCashUp()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $this->usersClosed = DB::table('cash_up')
            ->whereDate('close_date', $yesterday)
            ->leftJoin('users', 'cash_up.close_user_id', '=', 'users.id')
            ->select('users.*', DB::raw('DATE_FORMAT(cash_up.close_date, "%h:%i %p") as formatted_close_date'))
            ->get();
    }




    private function loadCustomers()
    {
        $this->customers = Customers::where('deleted', 0)->with('person')->get();

        $this->numberOfCustomers = $this->customers->count();
    }


    public function getNumberOfCustomers()
    {
        return $this->numberOfCustomers;
    }

    private function loadSupplier()
    {
        $this->suppliers = Supplier::where('deleted', 0)->with('people')->get();

        $this->numberOfSuppliers = $this->suppliers->count();
    }
    public function getNumberOfSuppliers()
    {
        return $this->numberOfSuppliers;
    }
    private function loadUser()
    {
        $this->users = User::where('deleted', 0)->with('people')->get();

        $this->numberOfUsers = $this->users->count();
    }
    public function getNumberOfUser()
    {
        return $this->numberOfUsers;
    }
    public function showSaleSuspendre()
    {
        $this->salesSuspendue = Sales::where('sale_status', 1)->get();
    }
    public function showSaleComplete()
    {
        $this->salesComplete = Sales::where('sale_status', 0)->get();
    }
    public function generateInvoice($saleId)
    {
        dd(1);

        $sale = Sales::findOrFail($saleId);
        $customer = Customers::findOrFail($sale->customer_id);
        $salesItems = SalesItems::where('sale_id', $saleId)->get();
        $totalPayments = SalesPayments::where('sale_id', $saleId)->sum('payment_amount');
        $htmlContent = view($this->viewName)
            ->with(['sale' => $sale, 'customer' => $customer, 'salesItems' => $salesItems, 'totalPayments' => $totalPayments])
            ->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfContent = $dompdf->output();
        return Response::streamDownload(
            function () use ($pdfContent) {
                print($pdfContent);
            },
            'facture.pdf'
        );
    }
}