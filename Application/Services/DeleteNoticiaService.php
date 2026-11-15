<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteNoticiaUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetNoticiaByIdPort.php';
require_once __DIR__ . '/../Ports/Out/DeleteNoticiaPort.php';
require_once __DIR__ . '/Dto/Commands/DeleteNoticiaCommand.php';
require_once __DIR__ . '/../../Domain/ValueObjects/NoticiaId.php';

/**
 * Caso de uso para eliminar una Noticia por su identificador.
 */
final class DeleteNoticiaService implements DeleteNoticiaUseCase
{
    private GetNoticiaByIdPort $getNoticiaByIdPort;
    private DeleteNoticiaPort $deleteNoticiaPort;

    public function __construct(
        GetNoticiaByIdPort $getNoticiaByIdPort,
        DeleteNoticiaPort $deleteNoticiaPort
    ) {
        $this->getNoticiaByIdPort = $getNoticiaByIdPort;
        $this->deleteNoticiaPort = $deleteNoticiaPort;
    }

    public function execute(DeleteNoticiaCommand $command): void
    {
        $noticiaId = new NoticiaId($command->getId());
        $existing = $this->getNoticiaByIdPort->getById($noticiaId);

        if ($existing === null) {
            throw new RuntimeException(sprintf('No se encontró la noticia con ID "%s".', $command->getId()));
        }

        $this->deleteNoticiaPort->delete($noticiaId);
    }
}