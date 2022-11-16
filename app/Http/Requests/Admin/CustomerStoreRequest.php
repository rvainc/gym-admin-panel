<?php

namespace App\Http\Requests\Admin;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
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
            'first_name' => ['required', 'string', 'max:100'],
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

                    $exists = DB::table('customers')
                        ->where('phone_number', $value)
                        ->when($this->route('customer'), function (Builder $builder, $model) {
                            return $builder->where('id', '!=', $model->id);
                        })
                        ->exists();
                    if ($exists) {
                        $fail(__('validation.unique'));
                    }
                },
            ],
            'card_number' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('customers', 'card_number')->ignore($this->route('customer'))
            ],
        ];
    }

    /**
     * @return null
     */
    protected function getModel()
    {
        return null;
    }
}
