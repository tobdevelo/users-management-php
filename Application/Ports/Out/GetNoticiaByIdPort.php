<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaId.php';

/**
 * Puerto de Salida (Output Port) para consultar una Noticia por su ID.
 */
interface GetNoticiaByIdPort
{
    public function getById(NoticiaId $id): ?NoticiaModel;
}