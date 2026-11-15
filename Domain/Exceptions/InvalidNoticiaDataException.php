<?php

declare(strict_types=1);

/**
 * Excepción de dominio lanzada cuando los datos de una Noticia incumplen reglas de negocio.
 */
final class InvalidNoticiaDataException extends DomainException
{
    public static function becauseFieldIsEmpty(string $field): self
    {
        return new self(sprintf('El campo "%s" de la noticia no puede estar vacío.', $field));
    }

    public static function becauseDateIsInvalid(string $field, string $value): self
    {
        return new self(sprintf('El formato de fecha "%s" en "%s" no es válido (esperado YYYY-MM-DD).', $value, $field));
    }

    public static function becauseNivelPublicoIsInvalid(string $value): self
    {
        return new self(sprintf('El nivel de público "%s" no es válido.', $value));
    }
}