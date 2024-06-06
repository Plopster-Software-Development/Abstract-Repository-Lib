<?php

namespace Plopster\AbstractRepository\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IAbstractRepository
{
    public function getAll(int $paginationLength): LengthAwarePaginator;
    public function getById(int|string $id): Model;
    public function create(array $data): Model;
    public function update(int|string $id, array $data): bool;
    public function delete(int|string $id): bool;
    public function findBy(array $criteria, array $columns = ['*']): Collection;
    public function updateOrCreate(array $attributes, array $values = []): Model;
    public function withRelations(int $paginationLength, array $relations): LengthAwarePaginator;
    public function search(int $paginationLength, string $keyword, array $columns = ['*']): LengthAwarePaginator;
}
