<?php

declare(strict_types=1);

use App\Services\DocumentValidatorService;

it('validates valid CPF document', function (string $document) {
    $validatorService = new DocumentValidatorService();
    $isValid = $validatorService->isValid($document);
    expect($isValid)->toBeTrue();
})->with([
    'with mask' => '916.300.800-98',
    'only numbers' => '94862046088',
]);

it('validates valid CNPJ document', function (string $document) {
    $validatorService = new DocumentValidatorService();
    $isValid = $validatorService->isValid($document);

    expect($isValid)->toBeTrue();
})->with([
    'with mask' => '71.608.665/0001-20',
    'only numbers' => '61389239000190',
]);

it('invalidates invalid CPF document', function (string $document) {
    $validatorService = new DocumentValidatorService();
    $isValid = $validatorService->isValid($document);

    expect($isValid)->toBeFalse();
})->with([
    'with mask' => '916.000.800-00',
    'only numbers' => '00862046001',
    'wrong length' => '04921528',
    'repeated numbers' => '11111111111',
    'text without numbers' => 'test',
    'empty value' => '',
]);

it('invalidates invalid CNPJ document', function (string $document) {
    $validatorService = new DocumentValidatorService();
    $isValid = $validatorService->isValid($document);
    expect($isValid)->toBeFalse();
})->with([
    'with mask' => '00.936.007/0001-03',
    'only numbers' => '99930072000177',
    'wrong length' => '12345678',
    'repeated numbers' => '99999999999999',
    'text without numbers' => 'test',
    'empty value' => '',
]);
