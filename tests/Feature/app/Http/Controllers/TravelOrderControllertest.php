<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\TravelOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TravelOrderControllertest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    private const BASE_URI = '/api/order';

    private $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->headers = ['Accept' => 'application/json'];
    }

    #[Test]
    public function create_order()
    {
        $this->actingAs($this->user);

        $data = TravelOrder::factory()->make()->toArray();
        $response = $this->postJson(
            self::BASE_URI,
            $data,
            $this->headers
        );

        $response->assertCreated()
            ->assertJsonFragment(['message' => 'Travel order created successfully']);
    }
}
