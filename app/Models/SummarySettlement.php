<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SummarySettlement extends Model
{

    protected $fillable = [
        'property_id',
        'landlord_id',
        'tenant_id',
        'summary_items',
        'total_summary_items',
        'show_account_number',
        'account_number',
        'due_date',
        'user_id',
        'property_id'
    ];

    protected $casts = [
        'summary_items' => 'array',
        'show_account_number' => 'boolean'
    ];

    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function landlord() : BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}

