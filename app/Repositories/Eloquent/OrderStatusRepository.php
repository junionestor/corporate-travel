<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderStatus;
use App\Repositories\Contracts\OrderStatusRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderStatusRepository extends EloquentRepository implements OrderStatusRepositoryInterface
{
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel(): Model
    {
        return app(OrderStatus::class);
    }

    public function query(): Builder
    {
        return $this->model->query();
    }
}
