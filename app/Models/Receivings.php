<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receivings extends Model
{
    protected $fillable = [
        'receiving_time',
        'supplier_id',
        'user_id',
        'comment',
        'payment_type',
        'reference',
        'receiving_type',
        'stock_source',
        'stock_destination',
    ];

    public function receivingItems()   
    {
        return $this->hasMany(ReceivingsItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}