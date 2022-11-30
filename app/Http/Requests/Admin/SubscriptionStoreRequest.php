<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:50'],
            'days' => ['required', 'integer'],
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }
}
