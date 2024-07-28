<?php

declare(strict_types=1);

namespace App\Services\Logs;

use Elastic\Elasticsearch\Client;

class ElasticSearchClientWrapper
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index(array $params)
    {
        return $this->client->index($params);
    }
}
