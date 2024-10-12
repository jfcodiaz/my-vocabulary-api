<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById($id): Model|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Model|null
    {
        $modelInstance = $this->model->find($id);
        if ($modelInstance) {
            $modelInstance->update($data);
            return $modelInstance;
        }

        return null;
    }

    public function delete($id): mixed
    {
        $modelInstance = $this->model->find($id);
        if ($modelInstance) {
            return $modelInstance->delete();
        }

        return false;
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }
}
