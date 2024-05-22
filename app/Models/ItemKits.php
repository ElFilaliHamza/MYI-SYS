<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKits extends Model
{
    protected $fillable = [
        'item_kit_number',
        'name',
        'kit_discount',
        'kit_discount_type',
        'price_option',
        'print_option',
        'description',
    ];

    public function itemKitItems()
{
    return $this->hasMany(ItemKitItems::class, 'item_kit_id');
}

}
