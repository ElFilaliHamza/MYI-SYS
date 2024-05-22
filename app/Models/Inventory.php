<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';

    protected $fillable = [
        'trans_items',
        'trans_user_id',
        'trans_date',
        'trans_comment',
        'trans_location',
        'trans_inventory',
    ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(Items::class, 'trans_items');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'trans_user');
    }

    public function location()
    {
        return $this->belongsTo(StockLocation::class, 'trans_location');
    }
}
