<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\OrderStatus;
use App\Models\TravelOrder;
use App\Models\User;
use App\Notifications\OrderApprovedNotification;
use App\Notifications\OrderCanceledNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
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
        Notification::fake();
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

    #[Test]
    public function update_order()
    {
        $updateOrderUser = User::factory()->create();
        $this->actingAs($updateOrderUser);

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
        ]);
        $data = [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::APPROVED,
        ];

        $response = $this->patchJson(
            self::BASE_URI,
            $data,
            $this->headers
        );

        $response->assertOk()
            ->assertJsonFragment(['message' => 'Travel order updated successfully']);

        $this->assertDatabaseHas('travel_orders', [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::APPROVED,
        ]);

        Notification::assertSentTo(
            $updateOrderUser,
            OrderApprovedNotification::class
        );
    }

    #[Test]
    public function cancel_oder()
    {
        $updateOrderUser = User::factory()->create();
        $this->actingAs($updateOrderUser);

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
        ]);
        $data = [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::CANCELED,
        ];

        $response = $this->patchJson(
            self::BASE_URI,
            $data,
            $this->headers
        );

        $response->assertOk()
            ->assertJsonFragment(['message' => 'Travel order updated successfully']);

        $this->assertDatabaseHas('travel_orders', [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::CANCELED,
        ]);

        Notification::assertSentTo(
            $updateOrderUser,
            OrderCanceledNotification::class
        );
    }

    #[Test]
    public function show_order()
    {
        $this->actingAs($this->user);

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->getJson(
            self::BASE_URI.'/'.$travelOrder->travel_order_id,
            $this->headers
        );

        $response->assertOk()
            ->assertJsonFragment(['travel_order_id' => $travelOrder->travel_order_id]);
    }

    #[Test]
    public function get_orders()
    {
        $this->actingAs($this->user);

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->getJson(
            self::BASE_URI,
            $this->headers
        );

        $response->assertOk()
            ->assertJsonFragment(['travel_order_id' => $travelOrder->travel_order_id]);
    }

    #[Test]
    public function cancel_order_after_7_days()
    {
        $this->actingAs(User::factory()->create());

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subDays(8),
        ]);
        $data = [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::CANCELED,
        ];

        $response = $this->patchJson(
            self::BASE_URI,
            $data,
            $this->headers
        );

        $response->assertBadRequest()
            ->assertJsonFragment(['message' => 'O Pedido excedeu o prazo de 7 dias para cancelamento.']);

        Notification::assertNothingSent();
    }

    #[Test]
    public function same_user_cant_update_order()
    {
        $this->actingAs($this->user);

        $travelOrder = TravelOrder::factory()->create([
            'user_id' => $this->user->id,
        ]);
        $data = [
            'travel_order_id' => $travelOrder->travel_order_id,
            'order_status_id' => OrderStatus::APPROVED,
        ];

        $response = $this->patchJson(
            self::BASE_URI,
            $data,
            $this->headers
        );

        $response->assertInternalServerError();
    }
}
