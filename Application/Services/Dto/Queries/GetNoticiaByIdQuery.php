<?php

declare(strict_types=1);

/**
 * Query DTO inmutable para consultar una Noticia específica por su identificador.
 */
final class GetNoticiaByIdQuery
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = trim($id);
    }

    public function getId(): string
    {
        return $this->id;
    }
}