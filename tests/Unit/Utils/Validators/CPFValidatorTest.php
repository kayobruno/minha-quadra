<?php

declare(strict_types=1);

use App\Contracts\DocumentValidator;
use App\Utils\Validators\CPFValidator;

it('checks if CPFValidator implements DocumentValidator interface', function () {
    $cpfValidator = new CPFValidator();
    expect($cpfValidator)->toBeInstanceOf(DocumentValidator::class);
});

it('validates valid CPF document', function (string $document) {
    $cpfValidator = new CPFValidator;

    expect($cpfValidator->isValid($document))->toBeTrue();
})->with([
    'with mask' => '916.300.800-98',
    'only numbers' => '94862046088',
]);

it('invalidates invalid CPF document', function (string $document) {
    $cpfValidator = new CPFValidator;

    expect($cpfValidator->isValid($document))->toBeFalse();
})->with([
    'with mask' => '916.000.800-00',
    'only numbers' => '00862046001',
    'wrong length' => '04921528',
    'repeated numbers' => '11111111111',
    'text without numbers' => 'test',
    'empty value' => '',
]);
