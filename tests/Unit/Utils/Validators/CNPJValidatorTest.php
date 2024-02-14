<?php

declare(strict_types=1);

use App\Contracts\DocumentValidator;
use App\Utils\Validators\CNPJValidator;

it('checks if CNPJValidator implements DocumentValidator interface', function () {
    $cpfValidator = new CNPJValidator();
    expect($cpfValidator)->toBeInstanceOf(DocumentValidator::class);
});

it('validates valid CNPJ document', function (string $document) {
    $cpfValidator = new CNPJValidator;

    expect($cpfValidator->isValid($document))->toBeTrue();
})->with([
    'with mask' => '71.608.665/0001-20',
    'only numbers' => '61389239000190',
]);

it('invalidates invalid CNPJ document', function (string $document) {
    $cpfValidator = new CNPJValidator;

    expect($cpfValidator->isValid($document))->toBeFalse();
})->with([
    'with mask' => '00.936.007/0001-03',
    'only numbers' => '99930072000177',
    'wrong length' => '12345678',
    'repeated numbers' => '99999999999999',
    'text without numbers' => 'test',
    'empty value' => '',
]);
