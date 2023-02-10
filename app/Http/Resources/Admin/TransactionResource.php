<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseJsonResource;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

/**
 * @property Transaction $resource
 */
class TransactionResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->resource->id,
                'customer_id' => $this->resource->customer_id,
                'subscription_id ' => $this->resource->subscription_id,
                'amount' => $this->resource->amount,
                'display_amount' => $this->resource->amount / 100,
                'start_at' => $this->formatDate($this->resource->start_at),
                'ends_at' => $this->formatDate($this->resource->ends_at),
                'created_at' => $this->formatDate($this->resource->created_at),
                'updated_at' => $this->formatDate($this->resource->update_at),
                'days' => $this->getDateDifference($this->resource->start_at, $this->resource->ends_at),
                'subscription' => SubscriptionResource::make($this->whenLoaded('subscription')),
                'customer' => CustomerResource::make($this->whenLoaded('customer')),
                'status' => check_transaction_status(
                    Carbon::parse($this->resource->start_at),
                    Carbon::parse($this->resource->ends_at)
                ),
            ],
            'links' => [
                'show_url' => route('admin.transactions.show', ['transaction' => $this->resource->id]),
            ],
        ];
    }
}
