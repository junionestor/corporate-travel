<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreTravelOrderRequest",
 *     type="object",
 *     title="Store Travel Order Request",
 *     description="Request body for storing a travel order",
 *     required={"travel_order_id", "name", "destination", "start_date", "end_date", "order_status_id"},
 *
 *     @OA\Property(
 *         property="travel_order_id",
 *         type="string",
 *         example="1",
 *         description="ID of the travel order"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=100,
 *         example="Clove",
 *         description="Name of the traveler"
 *     ),
 *     @OA\Property(
 *         property="destination",
 *         type="string",
 *         example="Ouro Preto",
 *         description="Destination of the travel"
 *     ),
 *     @OA\Property(
 *         property="start_date",
 *         type="string",
 *         format="date",
 *         example="2025-02-10",
 *         description="Start date of the travel"
 *     ),
 *     @OA\Property(
 *         property="end_date",
 *         type="string",
 *         format="date",
 *         example="2025-02-28",
 *         description="End date of the travel"
 *     ),
 *     @OA\Property(
 *         property="order_status_id",
 *         type="integer",
 *         example=1,
 *         description="ID of the order status"
 *     )
 * )
 */
class StoreTravelOrderRequest extends FormRequest
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
            'travel_order_id' => ['required'],
            'name' => ['required', 'string', 'max:100'],
            'destination' => ['required', 'string'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'order_status_id' => ['required', 'exists:order_statuses,id'],
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

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}
