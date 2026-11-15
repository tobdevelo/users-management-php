<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateNoticiaCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateNoticiaCommand.php';
require_once __DIR__ . '/../../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaCategoria.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaFecha.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaPais.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaDepartamento.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaCiudad.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaPeriodista.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaProgramaEmite.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaFechaEmision.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/NoticiaDescripcion.php';

/**
 * Mapper de Aplicación que transforma Commands en Modelos de Dominio NoticiaModel.
 */
final class NoticiaApplicationMapper
{
    public function fromCreateCommandToModel(CreateNoticiaCommand $command): NoticiaModel
    {
        return NoticiaModel::create(
            new NoticiaId($command->getId()),
            new NoticiaCategoria($command->getCategoria()),
            new NoticiaFecha($command->getFecha()),
            new NoticiaPais($command->getPais()),
            new NoticiaDepartamento($command->getDepartamento()),
            new NoticiaCiudad($command->getCiudad()),
            new NoticiaPeriodista($command->getPeriodista()),
            new NoticiaProgramaEmite($command->getProgramaEmite()),
            new NoticiaFechaEmision($command->getFechaEmision()),
            new NoticiaDescripcion($command->getDescripcion()),
            $command->getNivelPublico()
        );
    }

    public function applyUpdateCommandToModel(NoticiaModel $existing, UpdateNoticiaCommand $command): NoticiaModel
    {
        return $existing->update(
            new NoticiaCategoria($command->getCategoria()),
            new NoticiaFecha($command->getFecha()),
            new NoticiaPais($command->getPais()),
            new NoticiaDepartamento($command->getDepartamento()),
            new NoticiaCiudad($command->getCiudad()),
            new NoticiaPeriodista($command->getPeriodista()),
            new NoticiaProgramaEmite($command->getProgramaEmite()),
            new NoticiaFechaEmision($command->getFechaEmision()),
            new NoticiaDescripcion($command->getDescripcion()),
            $command->getNivelPublico()
        );
    }
}