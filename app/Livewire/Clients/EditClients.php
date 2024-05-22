<?php

namespace App\Livewire\Clients;

use App\Models\Customerpackages;
use App\Models\Customers;
use Livewire\Component;

class EditClients extends Component
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
    public $selectedCustomerId;
    public Customers $customer;
    public function render()
    {
        $this->packages = Customerpackages::all();
        return view('livewire.clients.edit-clients');
    }
    public function mount(int $ClientId)
    {
        $customer = Customers::findOrFail($ClientId);
        $this->edit($ClientId);
    }

    public function edit(int $ClientId)
    {
        if (auth()->user()->can('update Client')) {
        // dd($ClientId);
        $customer = Customers::findOrFail($ClientId);
        if ($customer) {
            # code...
            $this->selectedCustomerId = $ClientId;
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
            // dd('test');
        } else {
            return redirect()->to('/home');
        }
    } 
    else {
        abort(403, 'Unauthorized');
    }
    }

    public function update()
    {
        if (auth()->user()->can('update Client')) {
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
                $customer = Customers::with('person')->find($this->selectedCustomerId);
            // dd($customer);
            
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

            // $this->getAll();
            return redirect()->to('/clients' );
        }
    } 
    else {
        abort(403, 'Unauthorized');
    }
    }
}
