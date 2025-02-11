<?php

namespace Tests\Unit\app\Http\Requests;

use App\Http\Requests\UpdateTravelOrderRequest;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class UpdateTravelOrderRequestTest extends TestCase
{
    #[Test]
    public function validations(): void
    {
        $request = new UpdateTravelOrderRequest;

        $expectedRules = [
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

        $this->assertEquals(
            $expectedRules,
            $request->rules()
        );
    }
}
