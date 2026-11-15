<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteNoticiaCommand.php';

/**
 * Puerto de Entrada (Input Port) para el caso de uso de eliminación de Noticia.
 */
interface DeleteNoticiaUseCase
{
    public function execute(DeleteNoticiaCommand $command): void;
}