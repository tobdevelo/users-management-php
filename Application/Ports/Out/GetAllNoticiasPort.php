<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Salida (Output Port) para recuperar todas las Noticias.
 */
interface GetAllNoticiasPort
{
    /**
     * @return NoticiaModel[]
     */
    public function getAll(): array;
}