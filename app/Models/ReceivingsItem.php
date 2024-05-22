<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivingsItem extends Model
{
    protected $fillable = [
        'receiving_id',
        'item_id',
        'description',
        'serialnumber',
        // 'line',
        'quantity_purchased',
        'item_cost_price',
        'item_unit_price',
        'item_location',
        'receiving_quantity',
    ];

    // Define relationships
    public function receiving()
    {
        return $this->belongsTo(Receivings::class);
    }

    public function item()
    {
        return $this->belongsTo(Items::class);
    }
}