<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateNoticiaUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveNoticiaPort.php';
require_once __DIR__ . '/Dto/Commands/CreateNoticiaCommand.php';
require_once __DIR__ . '/Mappers/NoticiaApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Models/NoticiaModel.php';

/**
 * Caso de uso para registrar una nueva Noticia.
 */
final class CreateNoticiaService implements CreateNoticiaUseCase
{
    private SaveNoticiaPort $saveNoticiaPort;
    private NoticiaApplicationMapper $mapper;

    public function __construct(
        SaveNoticiaPort $saveNoticiaPort,
        NoticiaApplicationMapper $mapper
    ) {
        $this->saveNoticiaPort = $saveNoticiaPort;
        $this->mapper = $mapper;
    }

    public function execute(CreateNoticiaCommand $command): NoticiaModel
    {
        $noticia = $this->mapper->fromCreateCommandToModel($command);
        return $this->saveNoticiaPort->save($noticia);
    }
}