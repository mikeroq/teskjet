<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        \Storage::makeDirectory()
        return true;
    }

    public function rules(): array
    {
        return [
            'customer.name' => 'required',
            'customer.phone' => 'required|phone:US',
            'customer.type' => 'required',
            'customer.taxable' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'customer.name.required' => 'The name cannot be empty.',
            'customer.phone.required' => 'The phone cannot be empty.',
            'customer.phone.phone' => 'Must be a valid North American phone number.',
            'customer.type.required' => 'Please choose a type.',
        ];
    }
}
