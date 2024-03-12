<?php

namespace App\Models\trait\relationship;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductRelationship.
 */
trait CartDetailRelationship
{
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
