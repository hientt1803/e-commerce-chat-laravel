<?php

namespace App\Models\trait\relationship;

use App\Models\Customers;
use App\Models\Messages;
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

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class, 'cvs_id');
    }
}
