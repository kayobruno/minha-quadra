<?php

declare(strict_types=1);

namespace App\Contracts;

interface OrderRepository extends RepositoryReadable, RepositoryWritable, QueryBuilder
{
}
