<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidNoticiaDataException.php';

/**
 * Value Object inmutable para el identificador único (UUID) de la Noticia.
 */
final class NoticiaId
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = trim($value);
        if ($normalized === '') {
            throw InvalidNoticiaDataException::becauseFieldIsEmpty('id');
        }
        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(NoticiaId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}