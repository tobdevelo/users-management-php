<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetNoticiaByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Entrada (Input Port) para consultar una Noticia por ID.
 */
interface GetNoticiaByIdUseCase
{
    public function execute(GetNoticiaByIdQuery $query): ?NoticiaModel;
}