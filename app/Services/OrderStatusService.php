<?php

namespace App\Services;

use App\Repositories\Contracts\OrderStatusRepositoryInterface;

class OrderStatusService
{
    public function __construct(
        private readonly OrderStatusRepositoryInterface $orderStatusRepository
    ) {}

    public function getOrderStatus(?array $request)
    {
        $statuses = $this->orderStatusRepository->query();
        $request = collect($request);

        if ($request->has('id')) {
            $statuses->where('id', $request->get('id'));
        }

        if ($request->has('name')) {
            $statuses->where('name', $request->get('name'));
        }

        return $statuses->get(['id', 'name']);
    }
}
