<?php

namespace Tests\Unit\app\Http\Requests;

use App\Http\Requests\IndexTravelOrderRequest;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IndexTravelOrderRequestTest extends TestCase
{
    #[Test]
    public function validations(): void
    {
        $request = new IndexTravelOrderRequest();

        $expectedRules = [
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
            'destination' => [
                'string',
            ],
        ];

        $this->assertEquals(
            $expectedRules,
            $request->rules()
        );
    }
}
