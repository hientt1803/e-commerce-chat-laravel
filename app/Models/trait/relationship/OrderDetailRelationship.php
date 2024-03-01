<?php

namespace App\Models\trait\relationship;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductRelationship.
 */
trait OrderDetailRelationship
{
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
