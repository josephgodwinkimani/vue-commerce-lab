<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'billing_address' => 'required|string',
            'credit_card_last_four' => 'required|string|max:4',
            'credit_card_type' => 'required|string|max:255',
            'customer_id' => 'required|exists:customers,id',
            'customer_note' => 'nullable|string',
            'shipping_address' => 'required|string',
            'status' => 'required|string|max:255',
        ];

        return $rules;
    }
}
