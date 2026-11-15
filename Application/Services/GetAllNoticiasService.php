<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllNoticiasUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllNoticiasPort.php';
require_once __DIR__ . '/Dto/Queries/GetAllNoticiasQuery.php';
require_once __DIR__ . '/../../Domain/Models/NoticiaModel.php';

/**
 * Caso de uso (Query) para obtener el listado completo de Noticias.
 */
final class GetAllNoticiasService implements GetAllNoticiasUseCase
{
    private GetAllNoticiasPort $getAllNoticiasPort;

    public function __construct(GetAllNoticiasPort $getAllNoticiasPort)
    {
        $this->getAllNoticiasPort = $getAllNoticiasPort;
    }

    /**
     * @return NoticiaModel[]
     */
    public function execute(GetAllNoticiasQuery $query): array
    {
        return $this->getAllNoticiasPort->getAll();
    }
}