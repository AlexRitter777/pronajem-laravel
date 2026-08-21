<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettlementExpense extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'settlement_id',
        'expense_type_id',
        'expense_type_name',
        'amount'
    ];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }

    public function settlement(): BelongsTo
    {
        return $this->belongsTo(ServicesSettlement::class, 'settlement_id');
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(Expense::class, 'expense_type_id');
    }
}
