<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategories extends Model
{
    use HasFactory;

    protected $table = 'expense_categories';
    protected $fillable = [
        'category_name',
        'category_description',
        'deleted',
    ];
}
