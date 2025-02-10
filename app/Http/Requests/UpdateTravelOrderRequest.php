<?php

namespace App\Http\Requests;

use App\Models\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'travel_order_id' => [
                'required',
                'exists:travel_orders,travel_order_id',
            ],
            'order_status_id' => [
                'required',
                'exists:order_statuses,id',
                'in:'.OrderStatus::APPROVED.','.OrderStatus::CANCELED.'',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'travel_order_id.exists' => 'The travel order does not exist.',
            'order_status_id.exists' => 'The order status does not exist.',
            'order_status_id.in' => 'The :attribute must be :values.',
        ];
    }
}
