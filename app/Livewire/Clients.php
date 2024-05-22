<?php

namespace App\Livewire;

use App\Models\Customerpackages;
use App\Models\Customers;
use App\Models\People;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class Clients extends Component
{
    use WithPagination;
    #[Validate]
    public $firstName,
        $lastName,
        $gender,
        $phoneNumber,
        $email,
        $address1,
        $address2,
        $city,
        $zip,
        $country,
        $comments,
        $companyName,
        $accountNumber,
        $points;
    //pour recuperer username et l'id de l'utilisateur connecter
    public $userName;
    public $userId;
    //les variables pour getAll
    public $people;
    public $customers;
    //les variable pour la select des packages
    public $packages;
    public $selectedPackage;
    public $selectedCustomerId;

    public $formTitle = 'Ajouter client ';

    public $editForm = false;
    public $search;

    use WithPagination;

    public function render()
    {
        $this->getAll();
        $this->packages = Customerpackages::all();
        return view('livewire.clients', [
            'Customers' => Customers::where('deleted', 0)->paginate(10),
        ]);
    }
    public function rules()
    {
        return [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phoneNumber' => 'required|string',
            'email' => 'required|email|unique:people,email',
            'address1' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'companyName' => 'required|string',
            'accountNumber' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom est requis.',
            'phoneNumber.required' => 'Le numéro de téléphone est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'address1.required' => 'L\'adresse est requise.',
            'city.required' => 'La ville est requise.',
            'zip.required' => 'Le code postal est requis.',
            'country.required' => 'Le pays est requis.',
            'companyName.required' => 'Le nom de l\'entreprise est requis.',
            'accountNumber.required' => 'Le numéro de compte est requis.',
        ];
    }

    public function create()
    {
        if (auth()->user()->can('create Client')) {
            $this->validate();

                $person = People::create([
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

                $selectedPackageId = $this->selectedPackage;
                $customer = Customers::create([
                    'person_id' => $person->id,
                    'company_name' => $this->companyName,
                    'account_number' => $this->accountNumber,
                    'points' => 0,
                    'user_id' => Auth::user()->id,
                    'package_id' => $selectedPackageId,
                ]);

            $this->reset();
            session()->flash('success', 'client ajoute avec succès.');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function getUserNameFromId($userId)
    {
        $user = User::find($userId);
        if ($user) {
            return $user->name;
        } else {
            return null;
        }
    }

    public function mount()
    {
        $this->getAll();
        $userId = Auth::id();
        $this->userId = Auth::id();
        $this->userName = $this->getUserNameFromId($userId);
        $this->packages = Customerpackages::all();
    }

    public function destroy($customer_id)
    {
        if (auth()->user()->can('delete Client')) {
            $customer = Customers::find($customer_id);

            if (!$customer) {
                session()->flash('error', 'Le client n\'existe pas.');
            }

            $customer->update(['deleted' => 1]);
            session()->flash('success', 'Client supprimé avec succès.');
            $this->getAll();
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function edit(int $custId)
    {
        if (auth()->user()->can('update Client')) {
            $customer = Customers::find($custId);
            $this->selectedCustomerId = $custId;
            $this->firstName = $customer->person->first_name;
            $this->lastName = $customer->person->last_name;
            $this->gender = $customer->person->gender;
            $this->phoneNumber = $customer->person->phone_number;
            $this->email = $customer->person->email;
            $this->address1 = $customer->person->address_1;
            $this->address2 = $customer->person->address_2;
            $this->city = $customer->person->city;
            $this->zip = $customer->person->zip;
            $this->country = $customer->person->country;
            $this->comments = $customer->person->comments;
            $this->companyName = $customer->company_name;
            $this->accountNumber = $customer->account_number;
            $this->points = $customer->points;
            $this->selectedPackage = $customer->package_id;
        } else {
            abort(403, 'Unauthorized');
        }
    }
    public function update()
    {
        //     $this->validate([
        //         'firstName' => 'required|string',
        //         'lastName' => 'required|string',
        //         'gender' => 'nullable|in:M,F',
        //         'phoneNumber' => 'required|string',
        //         'email' => 'required|email',
        //         'address1' => 'required|string',
        //         'address2' => 'nullable|string',
        //         'city' => 'required|string',
        //         'zip' => 'required|string',
        //         'country' => 'required|string',
        //         'comments' => 'nullable|string',
        //         'companyName' => 'required|string',
        //         'accountNumber' => 'nullable|string',
        //         'points' => 'required|integer',
        //         'selectedPackage' => 'required',
        //     ]);
        if (auth()->user()->can('update Client')) {
            $customer = Customers::with('person')->find($this->selectedCustomerId);

            if ($customer) {
                $customer->person->update([
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

                $customer->update([
                    'company_name' => $this->companyName,
                    'account_number' => $this->accountNumber,
                    'points' => $this->points,
                    'package_id' => $this->selectedPackage,
                ]);

                $this->getAll();
                session()->flash('success', 'client a été mis à jour avec succès.');
            } else {
                session()->flash('error', 'L\'élément n\'a pas été trouvé.');
            }
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function getAll()
    {
        if (auth()->user()->can('read Client')) {
            if ($this->search) {
                $customersData = Customers::where('deleted', 0)
                    ->WhereHas('person', function ($query) {
                        $query
                            ->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('id', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%')
                            ->orWhere('company_name', 'like', '%' . $this->search . '%')
                            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%')
                            ->orWhere('gender', 'like', '%' . $this->search . '%')
                            ->orWhere('address_1', 'like', '%' . $this->search . '%');
                    })
                    ->with('person')
                    ->paginate(10);
            } else {
                $customersData = Customers::where('deleted', 0)->paginate(10);
            }

            $this->customers = $customersData->items();
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
