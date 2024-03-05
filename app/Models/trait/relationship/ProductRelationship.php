<?php

namespace App\Models\trait\relationship;

use App\Models\Cart_detail;
use App\Models\Categories;
use App\Models\Order_detail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */
trait ProductRelationship
{
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'cat_id');
    }

    public function cartDetail(): HasMany
    {
        return $this->hasMany(Cart_detail::class, 'product_id');
    }

    public function orderDetail(): HasMany
    {
        return $this->hasMany(Order_detail::class, 'product_id');
    }
}
