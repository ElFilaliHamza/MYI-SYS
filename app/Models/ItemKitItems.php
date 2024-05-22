<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemKitItems extends Model
{
    use HasFactory;
    protected $primarykey= null;

    protected $fillable = [
        'item_kit_id',
        'item_id',
        'quantity',
        'kit_sequence',
    ];


    public function itemKit()
    {
        return $this->belongsTo(ItemKits::class);
    }

 
    public function item()
    {
        return $this->belongsTo(Items::class);
    }
    public function getKey()
    {
        return ['item_id' => $this->item_id, 'item_kit_id' => $this->item_kit_id];
    }


    protected function setKeysForSaveQuery($query) {
        $keys = $this->getKey();
        foreach($keys as $keyName => $value) {
            $query->where($keyName, '=', $value);
        }
        return $query;
    }
}
