<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="IndexTravelOrderRequest",
 *     type="object",
 *     title="Index Travel Order Request",
 *     description="Request parameters for indexing travel orders",
 *
 *     @OA\Property(
 *         property="order_status_id",
 *         type="integer",
 *         description="ID of the order status",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         type="string",
 *         format="date",
 *         description="Start date of the travel order",
 *         example="2025-02-10"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         type="string",
 *         format="date",
 *         description="End date of the travel order",
 *         example="2025-01-28"
 *     ),
 *     @OA\Property(
 *         property="destination",
 *         type="string",
 *         description="Destination of the travel order",
 *         example="Belo Horizonte"
 *     )
 * )
 */
class IndexTravelOrderRequest extends FormRequest
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
            'order_status_id' => [
                'integer',
                'exists:order_statuses,id',
            ],
            'start_date' => [
                'date',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'date',
                'date_format:Y-m-d',
            ],
            'destination' => ['string'],
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
            'order_status_id.exists' => 'The order status does not exist.',
        ];
    }
}
