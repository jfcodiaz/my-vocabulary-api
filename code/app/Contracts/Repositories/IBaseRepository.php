<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface IBaseRepository
{
    /**
     * Retrieve all models.
     *
     * @return Collection|Model[]
     */
    public function getAll(): Collection;

    /**
     * Find a model by its primary key.
     *
     * @param int|string $id
     *
     * @return Model|null
     */
    public function findById($id): ?Model;

    /**
     * Create a new model with the given data.
     *
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update the model with the given data by its primary key.
     *
     * @param int|string $id
     * @param array $data
     *
     * @return Model|null
     */
    public function update($id, array $data): Model|null;

    /**
     * Delete a model by its primary key.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function delete($id): mixed;

    /**
     * Save a model instance.
     *
     * @param Model $model
     *
     * @return bool
     */
    public function save(Model $model): bool;
}
