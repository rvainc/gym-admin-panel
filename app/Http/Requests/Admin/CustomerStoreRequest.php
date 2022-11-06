<?php

namespace App\Http\Requests\Admin;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Propaganistas\LaravelPhone\PhoneNumber;

class CustomerStoreRequest extends FormRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'phone_number' => [
                'required',
                'string',
                'phone:AUTO,UA',
                function ($attribute, $value, $fail) {
                    try {
                        $value = PhoneNumber::make($value, ['AUTO','UA'])->formatE164();
                    } catch (Exception) {
                        return;
                    }

                    $exists = DB::table('customers')->where('phone_number', $value)->exists();
                    if ($exists) {
                        $fail(__('validation.unique'));
                    }
                },
            ],
            'card_number' => ['nullable', 'string', 'max:100'],
        ];
    }
}
