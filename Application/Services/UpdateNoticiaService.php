<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateNoticiaUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetNoticiaByIdPort.php';
require_once __DIR__ . '/../Ports/Out/UpdateNoticiaPort.php';
require_once __DIR__ . '/Dto/Commands/UpdateNoticiaCommand.php';
require_once __DIR__ . '/Mappers/NoticiaApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/NoticiaId.php';

/**
 * Caso de uso para actualizar los datos de una Noticia existente.
 */
final class UpdateNoticiaService implements UpdateNoticiaUseCase
{
    private GetNoticiaByIdPort $getNoticiaByIdPort;
    private UpdateNoticiaPort $updateNoticiaPort;
    private NoticiaApplicationMapper $mapper;

    public function __construct(
        GetNoticiaByIdPort $getNoticiaByIdPort,
        UpdateNoticiaPort $updateNoticiaPort,
        NoticiaApplicationMapper $mapper
    ) {
        $this->getNoticiaByIdPort = $getNoticiaByIdPort;
        $this->updateNoticiaPort = $updateNoticiaPort;
        $this->mapper = $mapper;
    }

    public function execute(UpdateNoticiaCommand $command): NoticiaModel
    {
        $noticiaId = new NoticiaId($command->getId());
        $existing = $this->getNoticiaByIdPort->getById($noticiaId);

        if ($existing === null) {
            throw new RuntimeException(sprintf('No se encontró la noticia con ID "%s".', $command->getId()));
        }

        $updated = $this->mapper->applyUpdateCommandToModel($existing, $command);
        return $this->updateNoticiaPort->update($updated);
    }
}