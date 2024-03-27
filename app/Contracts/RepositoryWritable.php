<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryWritable
{
    public function save(DataParam $dataParam): Model;

    public function update(string $id, DataParam $dataParam): Model;

    public function delete(string $id): void;
}
