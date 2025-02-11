<?php

namespace Tests\Unit\app\Http\Requests;

use App\Http\Requests\StoreTravelOrderRequest;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class StoreTravelOrderRequestTest extends TestCase
{
    #[Test]
    public function validations(): void
    {
        $request = new StoreTravelOrderRequest();

        $expectedRules = [
            'travel_order_id' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'destination' => [
                'required',
                'string',
            ],
            'start_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'order_status_id' => [
                'required',
                'integer',
                'exists:order_statuses,id',
            ],
        ];

        $this->assertEquals(
            $expectedRules,
            $request->rules()
        );
    }
}
