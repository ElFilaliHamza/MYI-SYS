<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    protected $fillable = [
        'person_id',
        'company_name',
        'agency_name',
        'account_number',
        'deleted',
        'category',
    ];

    public function people()
    {
        return $this->belongsTo(People::class, 'person_id');
    }
}
