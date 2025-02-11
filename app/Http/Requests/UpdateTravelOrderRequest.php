<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateTravelOrderRequest",
 *     type="object",
 *     title="Update Travel Order Request",
 *     description="Request body for updating a travel order",
 *     required={"travel_order_id", "order_status_id"},
 *
 *     @OA\Property(
 *         property="travel_order_id",
 *         type="string",
 *         description="ID of the travel order",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="order_status_id",
 *         type="integer",
 *         description="ID of the order status",
 *         example=2
 *     )
 * )
 */
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
                'string',
                'exists:travel_orders,travel_order_id',
            ],
            'order_status_id' => [
                'required',
                'integer',
                'exists:order_statuses,id',
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
        ];
    }
}
