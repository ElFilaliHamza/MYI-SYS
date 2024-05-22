<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\People;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        // Validate input
        $validator = Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'gender' => ['nullable', 'in:0,1'],
            'phone_number' => ['required', 'string'],
            'address_1' => ['required', 'string'],
            'address_2' => ['nullable', 'string'],
            'city' => ['required', 'string'],
            'zip' => ['required', 'string'],
            'country' => ['required', 'string'],
            'comments' => ['nullable', 'string'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Throw validation exception
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        // Create person
        $person = People::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'gender' => $input['gender'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'address_1' => $input['address_1'],
            'address_2' => $input['address_2'],
            'city' => $input['city'],
            'zip' => $input['zip'],
            'country' => $input['country'],
            'comments' => $input['comments'],
        ]);

        // Create user
        $user = User::create([
            'name' => $input['last_name'], 
            'email' => $input['email'], 
            'password' => Hash::make($input['password']),
            'person_id' => $person->id,
        ]);

        return $user;
    }
}