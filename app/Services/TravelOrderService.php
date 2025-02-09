<?php

namespace App\Services;

use App\Repositories\Contracts\TravelOrderRepositoryInterface;

class TravelOrderService
{
    public function __construct(
        private readonly TravelOrderRepositoryInterface $travelOrderRepository
    ) {
    }

    public function createOrder(array $request): void
    {
        $this->travelOrderRepository->create($request);
    }

    public function updateOrder(): void
    {
        // Update an existing order
    }

    public function deleteOrder(): void
    {
        // Delete an existing order
    }
}
