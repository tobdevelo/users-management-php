<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Salida (Output Port) para actualizar una Noticia existente.
 */
interface UpdateNoticiaPort
{
    public function update(NoticiaModel $noticia): NoticiaModel;
}