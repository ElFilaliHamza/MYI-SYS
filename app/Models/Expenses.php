<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'date',
        'amount',
        'payment_type',
        'expense_category_id',
        'description',
        'user_id',
        'deleted',
        'supplier_id'
    ];

  
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategories::class, 'expense_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
