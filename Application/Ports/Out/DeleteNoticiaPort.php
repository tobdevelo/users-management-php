<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaId.php';

/**
 * Puerto de Salida (Output Port) para eliminar una Noticia por su ID.
 */
interface DeleteNoticiaPort
{
    public function delete(NoticiaId $id): void;
}