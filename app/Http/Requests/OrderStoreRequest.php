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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string|max:255',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'credit_card_type' => 'required|string|max:255',
            'credit_card_last_four' => 'required|string|max:4',
            'quantity' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'customer_note' => 'nullable|string',
        ];
    }
}
