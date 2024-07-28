<?php

declare(strict_types=1);

use App\Contracts\LoggerInterface;
use App\Services\Logs\ElasticSearchClientWrapper;
use App\Services\Logs\ElasticSearchLoggerService;

beforeEach(function () {
    $this->client = Mockery::mock(ElasticSearchClientWrapper::class);
});

afterEach(function () {
    Mockery::close();
});

it('must implement the correct contract', function () {
    $elasticSearchService = new ElasticSearchLoggerService($this->client);

    expect($elasticSearchService)->toBeInstanceOf(LoggerInterface::class);
});

it('logs data correctly', function () {
    $elasticSearchService = new ElasticSearchLoggerService($this->client);

    $data = ['key' => 'value'];
    $params = [
        'index' => 'requests_responses_log',
        'body' => $data,
    ];

    $this->client->shouldReceive('index')
        ->with($params)
        ->once();

    $elasticSearchService->log($data);
});
