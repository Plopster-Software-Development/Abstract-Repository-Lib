<?php

namespace Plopster\AbstractRepository\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Plopster\AbstractRepository\Exceptions\AbstractRepositoryException;

interface IAbstractRepository
{
    public function getAll(int $paginationLength): LengthAwarePaginator | AbstractRepositoryException;
    public function getById(int|string $id): Model | AbstractRepositoryException;
    public function create(array $data): Model | AbstractRepositoryException;
    public function update(int|string $id, array $data): bool | AbstractRepositoryException;
    public function delete(int|string $id): bool | AbstractRepositoryException;
    public function findBy(array $criteria, array $columns = ['*']): Collection | AbstractRepositoryException;
    public function updateOrCreate(array $attributes, array $values = []): Model | AbstractRepositoryException;
    public function withRelations(int $paginationLength, array $relations): LengthAwarePaginator | AbstractRepositoryException;
    public function search(int $paginationLength, string $keyword, array $columns = ['*']): LengthAwarePaginator | AbstractRepositoryException;
}
