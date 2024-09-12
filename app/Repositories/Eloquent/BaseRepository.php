<?php

namespace App\Repositories\Eloquent;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{

    protected mixed $model;

    /** BaseRepository constructor. */
    public function __construct(mixed $model = null)
    {
        $this->model = $model;
    }

    public function all(): mixed
    {
        return $this->model->all();
    }

    public function findOrFail($id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function insert(array $data): mixed
    {
        return $this->model->insert($data);
    }

    public function  update($id, array $data): mixed
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete($id): mixed
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function first(): mixed
    {
        return $this->model->first();
    }

    public function last(): mixed
    {
        return $this->model->orderByDesc('id')->first();
    }

    public function updateOrCreate(array $data, array $attributes): mixed
    {
        return $this->model->updateOrCreate($data, $attributes);
    }

    public function firstOrCreate(array $data, array $attributes): mixed
    {
        return $this->model->firstOrCreate($data, $attributes);
    }
}
