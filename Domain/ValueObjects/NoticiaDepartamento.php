<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidNoticiaDataException.php';

/**
 * Value Object inmutable para el departamento donde ocurre la Noticia.
 */
final class NoticiaDepartamento
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = trim($value);
        if ($normalized === '') {
            throw InvalidNoticiaDataException::becauseFieldIsEmpty('departamento');
        }
        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}