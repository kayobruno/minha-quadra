<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface QueryBuilder
{
    public function builder(): Builder;
}
