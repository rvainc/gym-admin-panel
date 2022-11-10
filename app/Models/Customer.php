<?php

namespace App\Models;

use App\Traits\SmartSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $card_number
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Scopes
 * @method Builder|$this smartSearch(string $value)
 */
class Customer extends Model
{
    use HasFactory,
        SmartSearch;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'card_number',
    ];

    /**
     * @param Builder|Customer $builder
     * @param string $value
     * @return Builder
     */
    public function scopeSmartSearch(Builder $builder, string $value)
    {
        return $this->addSmartSearchConstraints(
            $builder,
            [
                'first_name',
                'last_name',
                'phone_number',
                'card_number',
            ],
            $value
        );
    }
}
