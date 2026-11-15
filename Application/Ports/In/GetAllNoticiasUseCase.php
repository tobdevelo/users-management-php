<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllNoticiasQuery.php';
require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Entrada (Input Port) para listar todas las Noticias.
 */
interface GetAllNoticiasUseCase
{
    /**
     * @return NoticiaModel[]
     */
    public function execute(GetAllNoticiasQuery $query): array;
}