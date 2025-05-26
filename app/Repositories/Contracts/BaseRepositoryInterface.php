<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function findWhere(array $criteria);
    public function paginate($perPage = 15);
} 