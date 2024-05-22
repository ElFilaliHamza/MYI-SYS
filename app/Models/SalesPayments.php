<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SalesPayments extends Model
{
    protected $table = 'sales_payments';
    protected $fillable = [
        'sale_id',
        'payment_type',
        'payment_amount',
        'cash_refund',
        'cash_adjustment',
        'user_id',
        'payment_time',
    ];

    
    public function sale()
    {
        return $this->belongsTo(Sales::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
