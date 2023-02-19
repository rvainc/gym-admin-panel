<?php

namespace App\Http\Requests\Admin;

class UserUpdateRequest extends BaseUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge_recursive(parent::rules(), [
            'password' => ['nullable'],
        ]);
    }
}
