<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

    protected $fillable = ['customer_id', 'person_id', 'company_name', 'account_number', 'points', 'deleted', 'date', 'user_id', 'package_id'];
    use HasFactory;


    public function person()
    {
        return $this->belongsTo(People::class, 'person_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(CustomerPackages::class, 'package_id');
    }
}
