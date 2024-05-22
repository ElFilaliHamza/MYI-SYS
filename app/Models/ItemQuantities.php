<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantities extends Model
{
    use HasFactory;
    protected $primarykey= null;
    protected $table = 'item_quantities';
    protected $fillable = [
        'item_id',
        'location_id',
        'quantity',
    ];

  
    public function item()
    {
        return $this->belongsTo(Items::class, 'location_id');
    }

    public function location()
    {
        return $this->belongsTo(StockLocation::class);
    }
    public function getKey()
    {
        return ['item_id' => $this->item_id, 'location_id' => $this->location_id];
    }
    protected function setKeysForSaveQuery($query) {
        $keys = $this->getKey();
        foreach($keys as $keyName => $value) {
            $query->where($keyName, '=', $value);
        }
        return $query;
    }
}
