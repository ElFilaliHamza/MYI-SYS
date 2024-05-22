<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['person_id', 'first_name', 'last_name', 'gender', 'phone_number', 'email', 'address_1', 'address_2', 'city', 'zip', 'country', 'comments'];
    use HasFactory;

    public function customers()
    {
        return $this->hasMany(Customers::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
