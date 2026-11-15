<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetNoticiaByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetNoticiaByIdPort.php';
require_once __DIR__ . '/Dto/Queries/GetNoticiaByIdQuery.php';
require_once __DIR__ . '/../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/NoticiaId.php';

/**
 * Caso de uso (Query) para consultar una Noticia por su identificador.
 */
final class GetNoticiaByIdService implements GetNoticiaByIdUseCase
{
    private GetNoticiaByIdPort $getNoticiaByIdPort;

    public function __construct(GetNoticiaByIdPort $getNoticiaByIdPort)
    {
        $this->getNoticiaByIdPort = $getNoticiaByIdPort;
    }

    public function execute(GetNoticiaByIdQuery $query): ?NoticiaModel
    {
        return $this->getNoticiaByIdPort->getById(new NoticiaId($query->getId()));
    }
}