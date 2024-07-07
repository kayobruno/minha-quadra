<?php

declare(strict_types=1);

use App\Enums\DocumentType;

it('returns all document types', function () {
    $expected = ['cpf', 'cnpj'];
    $actual = DocumentType::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each document type', function () {
    $cpfLabel = DocumentType::CPF->label();
    $cnpjLabel = DocumentType::CNPJ->label();

    $this->assertEquals('Pessoa Física', $cpfLabel);
    $this->assertEquals('Pessoa Jurídica', $cnpjLabel);
});
