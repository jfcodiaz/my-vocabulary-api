<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
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

    public function update($idOrModel, array $data): Model|null
    {
        $modelInstance = $idOrModel;

        if (is_int($idOrModel)) {
            $modelInstance = $this->model->find($idOrModel);
        }

        if ($modelInstance) {
            $modelInstance->update($data);

            return $modelInstance;
        }

        return null;
    }

    public function delete($idOrModel): mixed
    {
        if (is_int($idOrModel)) {
            return $this->model->destroy($idOrModel);
        }

        if ($idOrModel instanceof Model) {
            return $idOrModel->delete();
        }

        return false;
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }
}
