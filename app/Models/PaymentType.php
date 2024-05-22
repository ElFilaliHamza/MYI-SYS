<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $table = 'payment_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_type',
        'payment_amount',
        'receivings_id',
    ];

    /**
     * Get the receiving that owns the payment type.
     */
    public function receiving()
    {
        return $this->belongsTo(Receivings::class, 'receivings_id');
    }
}