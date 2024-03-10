<?php

namespace App\Models;

use App\Models\trait\relationship\CustomerRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    use CustomerRelationship;

    protected $table = 'customers';

    protected $primaryKey = "customer_id";

    public $timestamps = false;

    protected array $dates = ['create_at', 'update_at'];

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_name',
        'email',
        'password',
        'birthday',
        'address',
        'phone',
        'status',
        'create_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'update_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
