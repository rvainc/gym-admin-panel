<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseJsonResource;
use App\Models\Customer;

/**
 * @property Customer $resource
 */
class UserResource extends BaseJsonResource
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
                'name' => $this->resource->name,
                'email' => $this->resource->email,
                'role' => $this->resource->role,
                'role_text' => $this->resource->role->toString(),
                'email_verified_at' => $this->resource->email_verified_at,
                'created_at' => $this->resource->created_at,
                'updated_at' => $this->resource->updated_at,
            ],
            'links' => [
                'show_url' => route('admin.users.show', ['user' => $this->resource->id]),
                    'edit_url' => route('admin.users.edit', ['user' => $this->resource->id]),
                    'delete_url' => route('admin.users.destroy', ['user' => $this->resource->id]),
    //                'restore_url' => route('admin.users.restore', ['user' => $this->resource->id]),
            ],
            'meta' => [
                'can' => [
                    'view' => $this->can('view'),
                    'update' => $this->can('update'),
                    'delete' => $this->can('delete'),
                    'changeRole' => $this->can('changeRole'),
                ],
            ],
        ];
    }

    /**
     * @param string $ability
     * @return boolean
     */
    protected function can(string $ability)
    {
        return request()->user()->can($ability, $this->resource);
    }
}
