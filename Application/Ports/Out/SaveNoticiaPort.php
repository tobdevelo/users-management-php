<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';

/**
 * Puerto de Salida (Output Port) para persistir una nueva Noticia.
 */
interface SaveNoticiaPort
{
    public function save(NoticiaModel $noticia): NoticiaModel;
}