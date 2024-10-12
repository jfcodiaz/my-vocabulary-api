<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $modelInstance = $this->model->find($id);
        if ($modelInstance) {
            $modelInstance->update($data);
            return $modelInstance;
        }

        return null;
    }

    public function delete($id)
    {
        $modelInstance = $this->model->find($id);
        if ($modelInstance) {
            return $modelInstance->delete();
        }

        return false;
    }

    public function save(Model $model)
    {
        return $model->save();
    }
}
