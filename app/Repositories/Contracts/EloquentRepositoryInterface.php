<?php

namespace App\Repositories\Contracts;

interface EloquentRepositoryInterface
{
    public function query();
    public function find(int $id);
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function delete(int $id);
}
