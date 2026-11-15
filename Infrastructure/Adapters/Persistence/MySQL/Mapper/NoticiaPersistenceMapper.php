<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/NoticiaPersistenceDto.php';
require_once __DIR__ . '/../Entity/NoticiaEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaCategoria.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaFecha.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaPais.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaDepartamento.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaCiudad.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaPeriodista.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaProgramaEmite.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaFechaEmision.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaDescripcion.php';

/**
 * Data Mapper de persistencia entre NoticiaModel, NoticiaPersistenceDto, NoticiaEntity y filas MySQL.
 */
final class NoticiaPersistenceMapper
{
    public function fromModelToDto(NoticiaModel $noticia): NoticiaPersistenceDto
    {
        return new NoticiaPersistenceDto(
            $noticia->id()->value(),
            $noticia->categoria()->value(),
            $noticia->fecha()->value(),
            $noticia->pais()->value(),
            $noticia->departamento()->value(),
            $noticia->ciudad()->value(),
            $noticia->periodista()->value(),
            $noticia->programaEmite()->value(),
            $noticia->fechaEmision()->value(),
            $noticia->descripcion()->value(),
            $noticia->nivelPublico()
        );
    }

    public function fromDtoToEntity(NoticiaPersistenceDto $dto): NoticiaEntity
    {
        return new NoticiaEntity(
            $dto->id(),
            $dto->categoria(),
            $dto->fecha(),
            $dto->pais(),
            $dto->departamento(),
            $dto->ciudad(),
            $dto->periodista(),
            $dto->programaEmite(),
            $dto->fechaEmision(),
            $dto->descripcion(),
            $dto->nivelPublico()
        );
    }

    public function fromRowToEntity(array $row): NoticiaEntity
    {
        return new NoticiaEntity(
            (string) $row['id'],
            (string) $row['categoria'],
            (string) $row['fecha'],
            (string) $row['pais'],
            (string) $row['departamento'],
            (string) $row['ciudad'],
            (string) $row['periodista'],
            (string) $row['programa_emite'],
            (string) $row['fecha_emision'],
            (string) $row['descripcion'],
            (string) $row['nivel_publico'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(NoticiaEntity $entity): NoticiaModel
    {
        return new NoticiaModel(
            new NoticiaId($entity->id()),
            new NoticiaCategoria($entity->categoria()),
            new NoticiaFecha($entity->fecha()),
            new NoticiaPais($entity->pais()),
            new NoticiaDepartamento($entity->departamento()),
            new NoticiaCiudad($entity->ciudad()),
            new NoticiaPeriodista($entity->periodista()),
            new NoticiaProgramaEmite($entity->programaEmite()),
            new NoticiaFechaEmision($entity->fechaEmision()),
            new NoticiaDescripcion($entity->descripcion()),
            $entity->nivelPublico()
        );
    }

    public function fromRowToModel(array $row): NoticiaModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return NoticiaModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = [];

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}