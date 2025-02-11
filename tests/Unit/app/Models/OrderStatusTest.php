<?php

namespace Tests\Unit\app\Models;

use App\Models\OrderStatus;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class OrderStatusTest extends TestCase
{
    #[Test]
    public function it_has_approved_status(): void
    {
        $this->assertEquals(2, OrderStatus::APPROVED);
    }

    #[Test]
    public function test_it_has_canceled_status(): void
    {
        $this->assertEquals(3, OrderStatus::CANCELED);
    }
}
