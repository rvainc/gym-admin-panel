<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property string $title
 * @property int $days
 * @property int $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Subscription extends BaseModel
{
    use HasFactory,
        SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'days',
        'price',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'days' => 'integer',
        'price' => 'integer',
    ];
}
