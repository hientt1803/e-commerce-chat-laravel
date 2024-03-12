<?php

namespace App\Models\trait\relationship;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */
trait CustomerRelationship
{
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'customer_id');
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
