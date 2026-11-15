<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveNoticiaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateNoticiaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetNoticiaByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllNoticiasPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteNoticiaPort.php';

require_once __DIR__ . '/../Mapper/NoticiaPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/NoticiaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/NoticiaId.php';

/**
 * Adaptador de repositorio MySQL con PDO y Prepared Statements para Noticia.
 */
final class NoticiaRepositoryMySQL implements
    SaveNoticiaPort,
    UpdateNoticiaPort,
    GetNoticiaByIdPort,
    GetAllNoticiasPort,
    DeleteNoticiaPort
{
    private PDO $pdo;
    private NoticiaPersistenceMapper $mapper;

    public function __construct(PDO $pdo, NoticiaPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(NoticiaModel $noticia): NoticiaModel
    {
        $dto = $this->mapper->fromModelToDto($noticia);

        $sql = '
            INSERT INTO noticias (
                id,
                categoria,
                fecha,
                pais,
                departamento,
                ciudad,
                periodista,
                programa_emite,
                fecha_emision,
                descripcion,
                nivel_publico,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :categoria,
                :fecha,
                :pais,
                :departamento,
                :ciudad,
                :periodista,
                :programa_emite,
                :fecha_emision,
                :descripcion,
                :nivel_publico,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $dto->id(),
            ':categoria' => $dto->categoria(),
            ':fecha' => $dto->fecha(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':periodista' => $dto->periodista(),
            ':programa_emite' => $dto->programaEmite(),
            ':fecha_emision' => $dto->fechaEmision(),
            ':descripcion' => $dto->descripcion(),
            ':nivel_publico' => $dto->nivelPublico(),
        ]);

        $savedNoticia = $this->getById(new NoticiaId($dto->id()));

        if ($savedNoticia === null) {
            throw new RuntimeException('No se pudo recuperar la noticia después de guardarla.');
        }

        return $savedNoticia;
    }

    public function update(NoticiaModel $noticia): NoticiaModel
    {
        $dto = $this->mapper->fromModelToDto($noticia);

        $sql = '
            UPDATE noticias
               SET categoria = :categoria,
                   fecha = :fecha,
                   pais = :pais,
                   departamento = :departamento,
                   ciudad = :ciudad,
                   periodista = :periodista,
                   programa_emite = :programa_emite,
                   fecha_emision = :fecha_emision,
                   descripcion = :descripcion,
                   nivel_publico = :nivel_publico,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $dto->id(),
            ':categoria' => $dto->categoria(),
            ':fecha' => $dto->fecha(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':periodista' => $dto->periodista(),
            ':programa_emite' => $dto->programaEmite(),
            ':fecha_emision' => $dto->fechaEmision(),
            ':descripcion' => $dto->descripcion(),
            ':nivel_publico' => $dto->nivelPublico(),
        ]);

        $updatedNoticia = $this->getById(new NoticiaId($dto->id()));

        if ($updatedNoticia === null) {
            throw new RuntimeException('No se pudo recuperar la noticia después de actualizarla.');
        }

        return $updatedNoticia;
    }

    public function getById(NoticiaId $noticiaId): ?NoticiaModel
    {
        $sql = '
            SELECT
                id,
                categoria,
                fecha,
                pais,
                departamento,
                ciudad,
                periodista,
                programa_emite,
                fecha_emision,
                descripcion,
                nivel_publico,
                created_at,
                updated_at
            FROM noticias
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $noticiaId->value(),
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return NoticiaModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                categoria,
                fecha,
                pais,
                departamento,
                ciudad,
                periodista,
                programa_emite,
                fecha_emision,
                descripcion,
                nivel_publico,
                created_at,
                updated_at
            FROM noticias
            ORDER BY fecha_emision DESC, created_at DESC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(NoticiaId $noticiaId): void
    {
        $sql = 'DELETE FROM noticias WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $noticiaId->value(),
        ]);
    }
}