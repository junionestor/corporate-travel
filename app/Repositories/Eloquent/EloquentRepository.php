<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\EloquentRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements EloquentRepositoryInterface
{
    protected $model;

    abstract protected function resolveModel(): Model;

    public function query(): Builder
    {
        return $this->model->query();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }
}
