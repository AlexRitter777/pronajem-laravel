<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnualServiceSettlement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnualServiceSettlementFactory> */
    use HasFactory;


    protected $fillable = [

    ];

    public function property() : BelongsTo
    {
         return $this->belongsTo(Property::class);
    }




}
