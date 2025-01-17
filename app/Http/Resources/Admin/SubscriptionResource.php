<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseJsonResource;
use App\Models\Subscription;
use Illuminate\Http\Request;

/**
 * @property Subscription $resource
 */
class SubscriptionResource extends BaseJsonResource
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
                'title' => $this->resource->title,
                'days' => $this->resource->days,
                'price' => $this->resource->price,
                'display_price' => $this->resource->price / 100,
                'deleted_at' => $this->resource->deleted_at,
            ],
            'links' => [
                'delete_url' => route('admin.subscriptions.destroy', ['subscription' => $this->resource->id]),
                'restore_url' => route('admin.subscriptions.restore', ['subscription' => $this->resource->id]),
                'edit_url' => route('admin.subscriptions.edit', ['subscription' => $this->resource->id]),
            ],
        ];
    }
}
