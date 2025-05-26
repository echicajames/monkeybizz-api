<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($attributes);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function findWhere(array $criteria)
    {
        $query = $this->model->query();
        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }
        return $query->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
} 