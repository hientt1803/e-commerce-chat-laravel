<?php

namespace App\Models\trait\relationship;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */
trait ConversionRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer(): HasMany
    {
        return $this->hasMany(Customers::class, 'customer_id');
    }
}
