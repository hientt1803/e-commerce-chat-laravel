<?php

namespace App\Models\trait\relationship;

use App\Models\Customers;
use App\Models\Order_detail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */
trait OrderRelationship
{
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function orderDetail(): HasMany
    {
        return $this->hasMany(Order_detail::class, 'order_id');
    }
}
