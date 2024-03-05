<?php

namespace App\Models;

use App\Models\trait\relationship\MessageRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;
    use MessageRelationship;

    protected $table = 'messages';

    protected $primaryKey = "msg_id";

    public $timestamps = false;

    protected array $dates = ['create_at', 'update_at'];

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'status',
        'create_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function toArray(): array
    {
        $attributes = $this->attributesToArray();
        return array_merge($attributes, $this->relationsToArray());
    }
    /**
     * Get the name of the "created at" column.
     *
     * @return string
     */
    public function getCreatedAtColumn()
    {
        return 'create_at';
    }

    /**
     * Get the name of the "updated at" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        return 'update_at';
    }
}
