<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Traits\SmartSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property UserRole $role
 * @property string $phone_number
 * @property string $card_number
 * @property string $image
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Scopes
 * @method Builder|$this smartSearch(string $value)
 */
class Customer extends BaseModel
{
    use HasFactory,
        SmartSearch,
        SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'card_number',
    ];

    /**
     * @return HasMany|Transaction
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @return HasMany|Transaction
     */
    public function active_transactions()
    {
        return tap($this->transactions(), function (HasMany|Transaction $relation) {
            $relation->active();
        });
    }

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
