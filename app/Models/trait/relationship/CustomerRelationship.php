<?php

namespace App\Models\trait\relationship;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */
trait CustomerRelationship
{
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'order_id');
    }
}
