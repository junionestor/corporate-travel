<?php

namespace App\Repositories\Eloquent;

use App\Models\TravelOrder;
use App\Repositories\Contracts\TravelOrderRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TravelOrderRepository extends EloquentRepository implements TravelOrderRepositoryInterface
{
    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel(): Model
    {
        return app(TravelOrder::class);
    }

    public function query(): Builder
    {
        return $this->model->query();
    }
}
