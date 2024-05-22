<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashUp extends Model
{
    use HasFactory;

    protected $table = 'cash_up';

    protected $fillable = [
        'open_date',
        'close_date',
        'open_amount_cash',
        'transfer_amount_cash',
        'note',
        'closed_amount_cash',
        'closed_amount_card',
        'closed_amount_check',
        'closed_amount_total',
        'description',
        'open_user_id',
        'close_user_id',
        'closed_amount_due',
        'deleted'
    ];
}