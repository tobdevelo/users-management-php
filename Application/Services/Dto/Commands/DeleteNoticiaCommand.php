<?php

declare(strict_types=1);

/**
 * Command DTO inmutable para eliminar una Noticia por su identificador.
 */
final class DeleteNoticiaCommand
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