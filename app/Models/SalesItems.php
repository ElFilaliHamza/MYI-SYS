<?php
namespace App\Models;

use App\Models\Items;
use Illuminate\Database\Eloquent\Model;

class SalesItems extends Model
{
    protected $table = 'sales_items';
        protected $fillable = [
        'sale_id',
        'item_id',
        'description',
        'serialnumber',
        'quantity_purchased',
        'item_cost_price',
        'item_unit_price',
        'item_location',
    ];

    // Define relationships
    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }

    public function item()
    {
        return $this->belongsTo(Items::class);
    }

   public function location()
   {
       return $this->belongsTo(StockLocation::class, 'item_location');
   }
}
