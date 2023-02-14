<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property integer $subscription_id
 * @property integer $amount
 * @property Carbon $start_at
 * @property Carbon $ends_at
 * @property Carbon $created_at
 * @property Carbon $update_at
 *
 * Scopes
 * @method Builder|static active()
 */
class Transaction extends BaseModel
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'subscription_id',
        'amount',
        'start_at',
        'ends_at',
    ];

    /**
     * @return BelongsTo|Subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * @return BelongsTo|Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    protected function scopeActive(Builder $builder)
    {
        $now = Carbon::now();

        return $builder->whereDate('start_at', '<=', $now)
            ->whereDate('ends_at', '>', $now);
    }
}
