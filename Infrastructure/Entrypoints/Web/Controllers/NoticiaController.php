<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/NoticiaWebMapper.php';
require_once __DIR__ . '/../../../../Application/Ports/In/CreateNoticiaUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateNoticiaUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetNoticiaByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllNoticiasUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteNoticiaUseCase.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllNoticiasQuery.php';

/**
 * Controlador web desacoplado de HTTP para las operaciones CRUDL de Noticia.
 */
final class NoticiaController
{
    public function __construct(
        private CreateNoticiaUseCase $createNoticiaUseCase,
        private UpdateNoticiaUseCase $updateNoticiaUseCase,
        private GetNoticiaByIdUseCase $getNoticiaByIdUseCase,
        private GetAllNoticiasUseCase $getAllNoticiasUseCase,
        private DeleteNoticiaUseCase $deleteNoticiaUseCase,
        private NoticiaWebMapper $mapper
    ) {}

    /**
     * @return NoticiaResponse[]
     */
    public function index(): array
    {
        $noticias = $this->getAllNoticiasUseCase->execute(new GetAllNoticiasQuery());
        return $this->mapper->fromModelsToResponses($noticias);
    }

    public function show(string $id): NoticiaResponse
    {
        $noticia = $this->getNoticiaByIdUseCase->execute($this->mapper->fromIdToGetByIdQuery($id));
        if ($noticia === null) {
            throw new RuntimeException('No se encontró la noticia solicitada.');
        }
        return $this->mapper->fromModelToResponse($noticia);
    }

    public function store(CreateNoticiaWebRequest $request): NoticiaResponse
    {
        $noticia = $this->createNoticiaUseCase->execute($this->mapper->fromCreateRequestToCommand($request));
        return $this->mapper->fromModelToResponse($noticia);
    }

    public function update(UpdateNoticiaWebRequest $request): NoticiaResponse
    {
        $noticia = $this->updateNoticiaUseCase->execute($this->mapper->fromUpdateRequestToCommand($request));
        return $this->mapper->fromModelToResponse($noticia);
    }

    public function delete(string $id): void
    {
        $this->deleteNoticiaUseCase->execute($this->mapper->fromIdToDeleteCommand($id));
    }
}