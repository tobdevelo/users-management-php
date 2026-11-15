<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateNoticiaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Entrada (Input Port) para el caso de uso de creación de Noticia.
 */
interface CreateNoticiaUseCase
{
    public function execute(CreateNoticiaCommand $command): NoticiaModel;
}