<?php

namespace App\Repositories\Contracts;

interface EloquentRepositoryInterface
{
    public function query();

    public function resolveModel();
}
