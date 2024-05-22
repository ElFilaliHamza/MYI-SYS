<?php

namespace App\Livewire;

use App\Models\StockLocation;
use Livewire\Component;
use App\Models\User;
use App\Models\People;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Employee extends Component
{

    use WithPagination;

    public $search = '';
    public $users;
    public $authenticatedUserName;
    public $authenticatedUserId;
    public $selectedUserId;
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNumber;
    public $gender;
    public $address1;
    public $address2;
    public $city;
    public $zip;
    public $country;
    public $comments;
    public $password;
    public $password_confirmation;
    public $permissions = [];
    public $locations;
    public $venteLocations = [];
    public $entreeStockLocations = [];

    public function mount()
    {
        $this->loadUsers();
        $this->authenticatedUserName = Auth::user()->name;
        $this->authenticatedUserId = Auth::id();
        $this->locations = StockLocation::where('deleted',0)->get();
    }

    public function updatedSearch($value)
    {
        $this->loadUsers($value,);
    }

    public function loadUsers()
    {
        // if (auth()->user()->can('read Employés')) {
            if ($this->search) {
                $this->users = User::where('deleted', 0)
                    ->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                            ->orWhereHas('people', function ($query) {
                                $query->where('first_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%')
                                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');;
                            });
                    })
                    ->with('people')
                    ->paginate(3)->items();
            } else {
                // dd(User::where('deleted', 0)
                // ->with('people')
                // ->paginate(3)->items());

                $this->users = User::where('deleted', 0)
                    ->with('people')
                    ->paginate(3)->items();
            }
        // } else {
        //     abort(403, 'Unauthorized');
        // }
    }

    public function render()
    {
        $this->loadUsers();
        return view('livewire.employee',[
            'employeesData' => User::where('deleted', 0)
            ->with('people')
            ->paginate(3)
        ]);
    }

    public function deleteUser($userId, DeleteUser $deleteUserAction)
    {
        if (auth()->user()->can('delete Employés')) {
            $deleteUserAction->delete(User::find($userId));

            $this->loadUsers();
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function createUser()
    {
        // if (auth()->user()->can('create Employés')) {
            $this->validate([
                'firstName' => ['required', 'string'],
                'lastName' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => ['required', 'string'],
                'gender' => ['nullable', 'in:0,1'],
                'address1' => ['required', 'string'],
                'address2' => ['nullable', 'string'],
                'city' => ['required', 'string'],
                'zip' => ['required', 'string'],
                'country' => ['required', 'string'],
                'comments' => ['nullable', 'string'],
            ]);

            // Create person
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

            // Create user
            $user = User::create([
                'name' => $this->lastName,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'person_id' => $person->id,
            ]);

            $user->syncPermissions($this->permissions);

            // give the user the ventes permissions with the locations

            if(!empty($this->venteLocations)) {
                $ventePermission = Permission::where('name', "ventes")->first();
                foreach($this->venteLocations as $venteLocation) {
                    $idLocation = substr($venteLocation, strlen("vente_"));
                    $user->permissions()->attach($ventePermission->id, ['id_location' => $idLocation]);
                }
            }

            // give the user the entree stock permissions with the locations

            if(!empty($this->entreeStockLocations)) {
                $entreeStockPermission = Permission::where('name', "entrée stock")->first();
                foreach($this->entreeStockLocations as $entreeStockLocation) {
                    $idLocation = substr($entreeStockLocation, strlen("entreeStock_"));
                    $user->permissions()->attach($entreeStockPermission->id, ['id_location' => $idLocation]);
                }
            }

            $this->loadUsers();
            $this->clearFields();
        // } else {
        //     abort(403, 'Unauthorized');
        // }
    }

    public function editUser($userId)
    {
        if (auth()->user()->can('update Employés')) {
            $this->selectedUserId = $userId;

            $user = User::with('people')->find($userId);

            if ($user && $user->people) {
                $this->firstName = $user->people->first_name;
                $this->lastName = $user->people->last_name;
                $this->email = $user->people->email;
                $this->phoneNumber = $user->people->phone_number;
                $this->gender = $user->people->gender;
                $this->address1 = $user->people->address_1;
                $this->address2 = $user->people->address_2;
                $this->city = $user->people->city;
                $this->zip = $user->people->zip;
                $this->country = $user->people->country;
                $this->comments = $user->people->comments;
            } else
                $this->clearFields();
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function updateUser()
    {
        if (auth()->user()->can('update Employés')) {
            // Validation
            $this->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
                'phoneNumber' => 'required',
                'gender' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'country' => 'required',
            ]);

            // Update user details
            $user = User::find($this->selectedUserId);

            if ($user) {
                $user->update([
                    'name' => $this->lastName,
                    'email' => $this->email,
                ]);
            }

            // Update people details
            $people = $user->people;

            if ($people) {
                $people->update([
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'email' => $this->email,
                    'phone_number' => $this->phoneNumber,
                    'gender' => $this->gender,
                    'address_1' => $this->address1,
                    'address_2' => $this->address2,
                    'city' => $this->city,
                    'zip' => $this->zip,
                    'country' => $this->country,
                    'comments' => $this->comments,
                ]);
            }

            // Clear form fields
            $this->clearFields();

            // Reload users after update
            $this->loadUsers();
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function clearFields()
    {
        $this->firstName = '';
        $this->lastName = '';
        $this->email = '';
        $this->phoneNumber = '';
        $this->gender = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->zip = '';
        $this->country = '';
        $this->comments = '';
    }
}
