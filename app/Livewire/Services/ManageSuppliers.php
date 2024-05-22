<?php

namespace App\Livewire\Services;

use App\Models\People;
use Livewire\Component;
use App\Models\Supplier;

class ManageSuppliers extends Component
{
    public $selectedSupplierId;
    public $suppliers;
    public $companyName;
    public $category;
    public $agencyName;
    public $firstName;
    public $lastName;
    public $gender;
    public $email;
    public $phoneNumber;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip;
    public $country;
    public $comments;
    public $accountNumber;

    public function mount()
    {
        $this->loadSuppliers();
    }

    public function render()
    {
        return view('livewire.services.manage-suppliers');
    }

    public function loadSuppliers()
{
    $this->suppliers = Supplier::where('deleted', 0)->get();
}

public function editSupplier($supplierId)
    {
        $this->selectedSupplierId = $supplierId;

        $supplier = Supplier::with('people')->find($supplierId);

        if ($supplier) {
            $this->companyName = $supplier->company_name;
            $this->category = $supplier->category;
            $this->agencyName = $supplier->agency_name;
            $this->firstName = $supplier->people->first_name;
            $this->lastName = $supplier->people->last_name;
            $this->gender = $supplier->people->gender;
            $this->email = $supplier->people->email;
            $this->phoneNumber = $supplier->people->phone_number;
            $this->address1 = $supplier->people->address_1;
            $this->address2 = $supplier->people->address_2;
            $this->city = $supplier->people->city;
            $this->state = $supplier->people->state;
            $this->zip = $supplier->people->zip;
            $this->country = $supplier->people->country;
            $this->comments = $supplier->people->comments;
            $this->accountNumber = $supplier->account_number;
        }
    }

    public function updateSupplier()
    {
        $this->validate([
            'companyName' => 'required|string',
            'category' => 'nullable|string',
            'agencyName' => 'nullable|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'nullable|in:0,1',
            'email' => 'required|string',
            'phoneNumber' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'comments' => 'nullable|string',
            'accountNumber' => 'nullable|string',
        ]);

        $supplier = Supplier::with('people')->find($this->selectedSupplierId);

        if ($supplier) {
            $supplier->people->update([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'gender' => $this->gender,
                'phone_number' => $this->phoneNumber,
                'email' => $this->email,
                'address_1' => $this->address1,
                'address_2' => $this->address2,
                'city' => $this->city,
                'zip' => $this->zip,
                'country' => $this->country,
                'comments' => $this->comments,
            ]);

            $supplier->update([
                'company_name' => $this->companyName,
                'category' => $this->category,
                'agency_name' => $this->agencyName,
                'account_number' => $this->accountNumber,
            ]);

            $this->loadSuppliers();
            $this->resetFields();
        }
    }

    public function save()
    {
        $this->validate([
            'companyName' => 'required|string',
            'category' => 'nullable|string',
            'agencyName' => 'nullable|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'nullable|in:0,1',
            'email' => 'required|email|unique:people,email',
            'phoneNumber' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'comments' => 'nullable|string',
            'accountNumber' => 'nullable|string',
        ]);

        // Create person
        $people = People::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'gender' => $this->gender,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'address_1' => $this->address1,
            'address_2' => $this->address2,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
            'comments' => $this->comments,
        ]);

        // Create supplier
        Supplier::create([
            'company_name' => $this->companyName,
            'category' => $this->category,
            'agency_name' => $this->agencyName,
            'person_id' => $people->id,
            'account_number' => $this->accountNumber,
        ]);

        $this->loadSuppliers();

        // Reset fields and close modal
        $this->resetFields();
        
    }

    public function deleteSupplier($supplierId)
{
    // Find the supplier
    $supplier = Supplier::find($supplierId);

    if ($supplier) {
        // Soft delete the supplier by setting the 'deleted' column to 1
        $supplier->update(['deleted' => 1]);
        
        // Reload suppliers after soft deletion
        $this->loadSuppliers();
    }
}

    private function resetFields()
    {
        $this->companyName = '';
        $this->category = '';
        $this->agencyName = '';
        $this->firstName = '';
        $this->lastName = '';
        $this->gender = '';
        $this->email = '';
        $this->phoneNumber = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->country = '';
        $this->comments = '';
        $this->accountNumber = '';
    }
}







