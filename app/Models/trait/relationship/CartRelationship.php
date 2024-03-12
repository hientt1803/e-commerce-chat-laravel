<?php

namespace App\Models\trait\relationship;

use App\Models\Customers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductRelationship.
 */
trait CartRelationship
{
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}
