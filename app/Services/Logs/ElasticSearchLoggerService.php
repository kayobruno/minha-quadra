<?php

declare(strict_types=1);

namespace App\Services\Logs;

use App\Contracts\LoggerInterface;

final class ElasticSearchLoggerService implements LoggerInterface
{
    public function __construct(private ElasticSearchClientWrapper $client)
    {
    }

    public function log(array $data): void
    {
        $params = [
            'index' => 'requests_responses_log',
            'body' => $data,
        ];

        $this->client->index($params);
    }
}
