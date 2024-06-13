<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CourtRepository;
use App\DataTransferObjects\CourtData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourtService
{
    public function __construct(private readonly CourtRepository $courtRepository)
    {
    }

    public function getAll(): Collection
    {
        return $this->courtRepository->getAll();
    }

    public function save(CourtData $courtData): Model
    {
        return $this->courtRepository->save($courtData);
    }

    public function update(string $id, CourtData $courtData): Model
    {
        return $this->courtRepository->update($id, $courtData);
    }

    public function delete(string $id): void
    {
        $this->courtRepository->delete($id);
    }
}
