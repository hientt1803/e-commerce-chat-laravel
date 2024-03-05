<?php

namespace App\Models\trait\relationship;

use App\Models\Conversion;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductRelationship.
 */

trait MessageRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function conversion(): BelongsTo
    {
        return $this->belongsTo(Conversion::class, 'cvs_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }
}
