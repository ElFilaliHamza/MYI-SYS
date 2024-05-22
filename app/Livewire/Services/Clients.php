<?php

namespace App\Livewire\Services\Customer;

use App\Models\Customerpackages;
use Livewire\Component;
use App\Models\Customers;
use App\Models\People;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Clients extends Component
{
    public $firstName;
    public $lastName;
    public $gender;
    public $phoneNumber;
    public $email;
    public $address1;
    public $address2;
    public $city;
    public $zip;
    public $country;
    public $comments;
    public $companyName;
    public $accountNumber;
    public $points;
    //pour recuperer username et l'id de l'utilisateur connecter
    public $userName;
    public $userId;
    //les variables pour getAll 
    public $people;
    public $customers;
    //les variable pour la select des packages
    public $packages;
    public $selectedPackage;
    
    public function render()
    {
        $this->getAll();
        $this->packages = Customerpackages::all();
        return view('livewire..services.customer.customercontroller');
    }

    public function create()
    {
         $this->validate([
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
         ], [
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
        ]);
        
    

        
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
            'person_id' =>$person->id,
            'company_name' => $this->companyName,
            'account_number' => $this->accountNumber,
            'points' => 0,
            'user_id' => Auth::user()->id, 
            'package_id' => $selectedPackageId
        ]);
        $this->reset();
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
    public function getAll()
    {
    $this->customers = Customers::with('person')->where('deleted', '!=', 1)->get();
    }
 

    public function destroy($customer_id)
    {
        $customer = Customers::find($customer_id);
    
        if (!$customer) {
            session()->flash('error', 'Le client n\'existe pas.');
        }
    
        $customer->update(['deleted' => 1]);
             session()->flash('success', 'Client supprimé avec succès.');
             $this->getAll();
        
    }
}
