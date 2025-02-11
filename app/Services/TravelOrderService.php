<?php

namespace App\Services;

use App\Exceptions\CanceledOrderException;
use App\Models\OrderStatus;
use App\Notifications\OrderApprovedNotification;
use App\Notifications\OrderCanceledNotification;
use App\Repositories\Contracts\TravelOrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TravelOrderService
{
    public function __construct(
        private readonly TravelOrderRepositoryInterface $travelOrderRepository
    ) {}

    public function createOrder(array $request): void
    {
        $this->travelOrderRepository->create(
            array_merge($request, ['user_id' => Auth::user()->id])
        );
    }

    public function updateOrder(array $request): void
    {
        $travelOrder = $this->travelOrderRepository
            ->query()
            ->where('travel_order_id', $request['travel_order_id'])
            ->first();

        if ((int) $request['order_status_id'] === OrderStatus::CANCELED) {
            $this->cancelOrder($request['travel_order_id']);

            return;
        }

        Gate::authorize('update', $travelOrder);

        $this->travelOrderRepository->update(
            $travelOrder->id,
            $request
        );

        auth()->user()
            ->notify(new OrderApprovedNotification($travelOrder));
    }

    public function showOrder($travelOrderId)
    {
        $travelOrder = $this->travelOrderRepository
            ->query()
            ->where('travel_order_id', $travelOrderId)
            ->first();

        Gate::authorize('view', $travelOrder);

        return $travelOrder;
    }

    public function getOrders(array $request)
    {
        $request = collect($request);
        $user = Auth::user();
        $travelOrders = $this->travelOrderRepository->query();

        if ($request->has('order_status_id')) {
            $travelOrders->where('order_status_id', $request->get('order_status_id'));
        }

        if ($request->has('start_date') || $request->get('end_date')) {
            $travelOrders = $this->dateFilter(
                $travelOrders,
                $request->get('start_date'),
                $request->get('end_date')
            );
        }

        if ($request->has('destination')) {
            $travelOrders->where('destination', 'like', '%'.$request->get('destination').'%');
        }

        return $travelOrders
            ->where('user_id', $user->id)
            ->get();
    }

    public function cancelOrder($travelOrderId)
    {
        $travelOrder = $this->travelOrderRepository
            ->query()
            ->where('travel_order_id', $travelOrderId)
            ->first();

        if (
            ! $travelOrder
            || $travelOrder?->created_at?->diffInDays(now()) > 7
        ) {
            throw new CanceledOrderException;
        }

        Gate::authorize('update', $travelOrder);

        $this->travelOrderRepository->update(
            $travelOrder->id,
            ['order_status_id' => OrderStatus::CANCELED]
        );

        auth()->user()
            ->notify(new OrderCanceledNotification($travelOrder));
    }

    private function dateFilter($query, $start = null, $end = null)
    {
        if ($start && $end) {
            return $query->whereBetween('start_date', [$start, $end])
                ->orWhereBetween('end_date', [$start, $end])
                ->orWhereBetween('created_at', [$start, $end]);
        }

        if ($start) {
            return $query->where('start_date', '>=', $start)
                ->orWhere('end_date', '>=', $start)
                ->orWhere('created_at', '>=', $start);
        }

        if ($end) {
            return $query->where('start_date', '<=', $end)
                ->orWhere('end_date', '<=', $end)
                ->orWhere('created_at', '<=', $end);
        }
    }
}
