<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function settlementExpenses(): HasMany
    {
        return $this->hasMany(SettlementExpense::class, 'expense_type_id');
    }
}
