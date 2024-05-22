<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\People;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $person = People::create([
            'first_name' => 'Kamal',
            'last_name' => 'HAMIDI',
            'phone_number' => '0770016813',
            'email' => 'hamidi.kamal@gmail.com',
            'address_1' => '123 street',
            'address_2' => '',
            'city' => 'Nairobi',
            'zip' => '00100',
            'country' => 'Kenya',
            'comments' => '',
        ]);

        // Create or retrieve the user
        $user = User::create([
            'name' => 'hamidi',
            'email' => 'hamidi.kamal@gmail.com',
            'password' => Hash::make('kamal123'),
            'person_id' => $person->id,
        ]);

        // Assign super-admin role
        $user->assignRole('super-admin');
    }
}






