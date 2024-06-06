<?php

namespace Plopster\AbstractRepository\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Plopster\AbstractRepository\Contracts\IAbstractRepository;

abstract class AbstractRepository implements IAbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records with pagination.
     *
     * @param {number} $paginationLength - The number of items per page.
     * @return {LengthAwarePaginator} - An instance of LengthAwarePaginator containing the paginated results.
     */
    public function getAll(int $paginationLength): LengthAwarePaginator
    {
        return $this->model->paginate($paginationLength);
    }

    /**
     * Retrieves a model instance by its identifier.
     * If the model is not found, it throws a model not found exception.
     *
     * @param {int|string} $id - The primary key of the model to retrieve.
     * @return {Model} The retrieved model instance.
     */
    public function getById(int|string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Creates a new record using the provided data.
     *
     * @param {array} $data The data to be used for creating a new record in the model.
     * @return Model Returns an instance of the model with the new record.
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Updates the model with the given identifier with the new data provided.
     *
     * @param {int|string} id - The identifier of the model to update.
     * @param {array} data - The new data to update the model with.
     * @return {bool} Returns true if the update was successful, otherwise false.
     */
    public function update(int|string $id, array $data): bool
    {
        $localModel = $this->getById($id);
        return $localModel->update($data);
    }

    /**
     * Deletes a model from the database by its ID.
     * @param {int|string} $ fsdfsdffsdidentifies the model to delete.
     * @return {bool} Returns true if the model was successfully deleted.
     */
    public function delete(int|string $id): bool
    {
        $localModel = $this->getById($id);
        return $localModel->delete();
    }

    /**
     * Retrieve a collection of models based on specific criteria.
     *
     * @param {Array} criteria - The conditions to filter the models.
     * @param {Array} [columns=['*']] - The specific columns to select, defaults to all.
     * @return {Collection} The collection of retrieved models.
     */
    public function findBy(array $criteria, array $columns = ['*']): Collection
    {
        return $this->model->where($criteria)->get($columns);
    }

    /**
     * Update an existing model or create a new one with the given attributes and values.
     *
     * @param {array} $attributes - The attributes to find the model or create a new one.
     * @param {array} $values - Optional. The values to be assigned to the model's attributes.
     * @return {Model} - The updated or newly created model instance.
     */
    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Retrieves a paginated list of model instances with eager loaded relations.
     *
     * @param   {number} paginationLength The number of items per page.
     * @param   {string[]} relations      An array of relation names to be eager loaded.
     * @return {LengthAwarePaginator}     Returns an instance of LengthAwarePaginator with the paginated result.
     */
    public function withRelations(int $paginationLength, array $relations): LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate($paginationLength);
    }

    /**
     * Perform a search on the model based on the given keyword and in specified columns.
     * The function returns a paginator with the results.
     *
     * @param {string} keyword - The keyword to search for in the model fields.
     * @param {string[]} [columns=['*']] - The columns to include in the result set.
     * @return {LengthAwarePaginator} - The paginated result set.
     */
    public function search(int $paginationLength, string $keyword, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
        })->paginate($paginationLength, $columns);
    }
}
