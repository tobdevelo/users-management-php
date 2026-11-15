<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateNoticiaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Entrada (Input Port) para el caso de uso de actualización de Noticia.
 */
interface UpdateNoticiaUseCase
{
    public function execute(UpdateNoticiaCommand $command): NoticiaModel;
}