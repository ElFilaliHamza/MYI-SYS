<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLocation extends Model
{
    use HasFactory;
    protected $table = 'stock_location';

    protected $fillable = [
        'id',
        'location_name',
        'deleted',
    ];

    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function receivings_items(){
        return $this->hasMany(ReceivingsItem::class);
    }
}
