<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\CourtRepository;
use App\Contracts\DataParam;
use App\Models\Court;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CourtEloquentRepository implements CourtRepository
{
    public function __construct(private readonly Court $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model::paginate();
    }

    public function findById(string $id): Court
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Court
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Court
    {
        $court = $this->model::whereId($id)->first();
        $court->update($dataParam->toArray());

        return $court;
    }

    public function delete(string $id): void
    {
        $court = $this->model::whereId($id)->first();
        $court->delete();
    }

    public function builder(): Builder
    {
        return $this->model::query();
    }
}
