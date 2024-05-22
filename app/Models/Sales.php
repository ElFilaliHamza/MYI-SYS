<?php
namespace App\Models;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';

    protected $fillable = [
        'sale_time',
        'customer_id',
        'comment',
        'invoice_number',
        'quote_number',
        'sale_status',
        'work_order_number',
        'user_id',
    ];

    // Define relationships
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
