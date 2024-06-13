<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\CourtRepository;
use App\Contracts\DataParam;
use App\Models\Court;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourtEloquentRepository implements CourtRepository
{
    public function getAll(): Collection
    {
        return Court::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Court::paginate();
    }

    public function findById(string $id): Model
    {
        return Court::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Model
    {
        return Court::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $court = Court::whereId($id)->first();
        $court->update($dataParam->toArray());

        return $court;
    }

    public function delete(string $id): void
    {
        $court = Court::whereId($id)->first();
        $court->delete();
    }

    public function builder(): Builder
    {
        return Court::query();
    }
}
