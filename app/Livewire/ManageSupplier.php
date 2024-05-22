<?php

namespace App\Livewire;

use App\Models\People;
use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Validate;

class ManageSupplier extends Component
{
    use WithPagination;

    #[Validate]
    public $companyName, $category, $agencyName, $firstName, $lastName, $gender, $email, $phoneNumber, $address_1, $address_2, $city, $state, $zip,
        $country, $comments, $accountNumber;

    public $search = '';
    public $selectedSupplierId;
    public $suppliers;

    public function mount()
    {
        $this->loadSuppliers();
    }

    public function render()
    {

        return view('livewire.manage-suppliers');
    }

    public function messages()
    {
        return [
            'companyName.required' => 'Ce champ est obligatoire',
            'category.required' => 'Ce champ est obligatoire',
            'agencyName.required' => 'Ce champ est obligatoire',
            'firstName.required' => 'Ce champ est obligatoire',
            'lastName.required' => 'Ce champ est obligatoire',
            'gender.required' => 'Ce champ est obligatoire',
            'email.required' => 'The email address is required.',
            'email.email' => 'Veuillez entrer une addresse valide',
            'email.regex' => 'Veuillez entrer une addresse valide',
            'accountNumber' => 'Ce champ est obligatoire',
        ];
    }

    public function rules()
    {
        return [
            'companyName' => 'required|string',
            'category' => 'required|string',
            'agencyName' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'gender' => 'required|in:0,1',
            'email' => 'required|email|regex:/^.+@.+$/i',
            'phoneNumber' => 'nullable|string',
            'address_1' => 'nullable|string',
            'address_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'country' => 'nullable|string',
            'comments' => 'nullable|string',
            'accountNumber' => 'required|string',

        ];
    }

    public function updatedSearch($value)
    {
        $this->loadSuppliers($value);
    }

    public function loadSuppliers()
    {
        if (auth()->user()->can('read Fournisseurs')) {
            if ($this->search) {
                $suppliersData = Supplier::where('deleted', 0)
                    ->WhereHas('people', function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('id', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('company_name', 'like', '%' . $this->search . '%')
                            ->orWhere('agency_name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                            ->orWhere('category', 'like', '%' . $this->search . '%');
                    })->with('people')->paginate(10);
            } else {
                $suppliersData = Supplier::where('deleted', 0)->paginate(10);
            }

            $this->suppliers = $suppliersData->items();
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function editSupplier($supplierId)
    {
        if (auth()->user()->can('update Fournisseurs')) {
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
                $this->address_1 = $supplier->people->address_1;
                $this->address_2 = $supplier->people->address_2;
                $this->city = $supplier->people->city;
                $this->state = $supplier->people->state;
                $this->zip = $supplier->people->zip;
                $this->country = $supplier->people->country;
                $this->comments = $supplier->people->comments;
                $this->accountNumber = $supplier->account_number;
            }
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function updateSupplier()
    {
        if (auth()->user()->can('update Fournisseurs')) {
            $this->validate();

            $supplier = Supplier::with('people')->find($this->selectedSupplierId);

            if ($supplier) {
                $supplier->people->update([
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'gender' => $this->gender,
                    'phone_number' => $this->phoneNumber,
                    'email' => $this->email,
                    'address_1' => $this->address_1,
                    'address_2' => $this->address_2,
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
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function save()
    {
        if (auth()->user()->can('create Fournisseurs')) {
            $this->validate();

            // Create person
            $people = People::create([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'gender' => $this->gender,
                'phone_number' => $this->phoneNumber,
                'email' => $this->email,
                'address_1' => $this->address_1,
                'address_2' => $this->address_2,
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
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function deleteSupplier($supplierId)
    {
        if (auth()->user()->can('delete Fournisseurs')) {
            // Find the supplier
            $supplier = Supplier::find($supplierId);

            if ($supplier) {
                // Soft delete the supplier by setting the 'deleted' column to 1
                $supplier->update(['deleted' => 1]);

                // Reload suppliers after soft deletion
                $this->loadSuppliers();
            }
        } else {
            abort(403, 'Unauthorized');
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
        $this->adresse1 = '';
        $this->adresse2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->country = '';
        $this->comments = '';
        $this->accountNumber = '';
    }
}