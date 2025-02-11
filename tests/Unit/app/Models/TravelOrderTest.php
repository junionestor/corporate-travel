<?php

namespace Tests\Unit\app\Models;

use App\Models\TravelOrder;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TravelOrderTest extends TestCase
{
    #[Test]
    public function it_has_fillable_fields(): void
    {
        $travelOrder = new TravelOrder();

        $this->assertEquals(
            [
                'travel_order_id',
                'name',
                'destination',
                'user_id',
                'start_date',
                'end_date',
                'order_status_id',
            ],
            $travelOrder->getFillable()
        );
    }
}
