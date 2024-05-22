<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'item_number',
        'description',
        'cost_price',
        'unit_price',
        'pic_filename',
        'stock_type',
        'item_type',
        'deleted',
        
    ];
    public function itemKitItems()
    {
        return $this->hasMany(ItemKitItems::class, 'item_kit_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
