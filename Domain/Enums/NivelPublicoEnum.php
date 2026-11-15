<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidNoticiaDataException.php';

/**
 * Enumeración de valores permitidos para el nivel de público de una Noticia.
 */
final class NivelPublicoEnum
{
    public const GENERAL = 'GENERAL';
    public const INFANTIL = 'INFANTIL';
    public const JUVENIL = 'JUVENIL';
    public const ADULTO = 'ADULTO';

    public static function values(): array
    {
        return [
            self::GENERAL,
            self::INFANTIL,
            self::JUVENIL,
            self::ADULTO,
        ];
    }

    public static function ensureIsValid(string $value): void
    {
        if (!in_array(strtoupper(trim($value)), self::values(), true)) {
            throw InvalidNoticiaDataException::becauseNivelPublicoIsInvalid($value);
        }
    }
}