<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateNoticiaRequest.php';
require_once __DIR__ . '/../Dto/UpdateNoticiaRequest.php';
require_once __DIR__ . '/../Dto/NoticiaResponse.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateNoticiaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateNoticiaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteNoticiaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetNoticiaByIdQuery.php';
require_once __DIR__ . '/../../../../../Domain/Models/NoticiaModel.php';

/**
 * Mapper de presentación que traduce WebRequests a Commands/Queries y Models a WebResponses.
 */
final class NoticiaWebMapper
{
    public function fromCreateRequestToCommand(CreateNoticiaWebRequest $request): CreateNoticiaCommand
    {
        return new CreateNoticiaCommand(
            $request->id(),
            $request->categoria(),
            $request->fecha(),
            $request->pais(),
            $request->departamento(),
            $request->ciudad(),
            $request->periodista(),
            $request->programaEmite(),
            $request->fechaEmision(),
            $request->descripcion(),
            $request->nivelPublico()
        );
    }

    public function fromUpdateRequestToCommand(UpdateNoticiaWebRequest $request): UpdateNoticiaCommand
    {
        return new UpdateNoticiaCommand(
            $request->id(),
            $request->categoria(),
            $request->fecha(),
            $request->pais(),
            $request->departamento(),
            $request->ciudad(),
            $request->periodista(),
            $request->programaEmite(),
            $request->fechaEmision(),
            $request->descripcion(),
            $request->nivelPublico()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetNoticiaByIdQuery
    {
        return new GetNoticiaByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteNoticiaCommand
    {
        return new DeleteNoticiaCommand($id);
    }

    public function fromModelToResponse(NoticiaModel $noticia): NoticiaResponse
    {
        return new NoticiaResponse(
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

    /**
     * @param NoticiaModel[] $noticias
     * @return NoticiaResponse[]
     */
    public function fromModelsToResponses(array $noticias): array
    {
        return array_map(
            fn(NoticiaModel $noticia): NoticiaResponse => $this->fromModelToResponse($noticia),
            $noticias
        );
    }
}