<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseJsonResource;
use App\Models\Customer;

/**
 * @property Customer $resource
 */
class CustomerResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->resource->id,
                'first_name' => $this->resource->first_name,
                'last_name' => $this->resource->last_name,
                'full_name' => trim(implode(' ', [$this->resource->first_name, $this->resource->last_name])),
                'phone_number' => $this->resource->phone_number,
                'card_number' => $this->resource->card_number,
                'deleted_at' => $this->resource->deleted_at,
                'active_transactions_exists' => $this->whenNotNull($this->resource->active_transactions_exists),
            ],
            'links' => [
                'show_url' => route('admin.customers.show', ['customer' => $this->resource->id]),
                'edit_url' => route('admin.customers.edit', ['customer' => $this->resource->id]),
                'delete_url' => route('admin.customers.delete', ['customer' => $this->resource->id]),
                'restore_url' => route('admin.customers.restore', ['customer' => $this->resource->id]),
            ]
        ];
    }
}
