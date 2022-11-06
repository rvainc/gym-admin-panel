<?php

namespace App\Http\Resources\Admin;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Customer $resource
 */
class CustomerResource extends JsonResource
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
            ]
        ];
    }
}
