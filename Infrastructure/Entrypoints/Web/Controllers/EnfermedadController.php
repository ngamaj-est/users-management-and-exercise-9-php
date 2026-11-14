<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/EnfermedadWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateEnfermedadUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateEnfermedadUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetEnfermedadByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllEnfermedadesUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteEnfermedadUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllEnfermedadesQuery.php';

final class EnfermedadController
{
    private CreateEnfermedadUseCase    $createEnfermedadUseCase;
    private UpdateEnfermedadUseCase    $updateEnfermedadUseCase;
    private GetEnfermedadByIdUseCase   $getEnfermedadByIdUseCase;
    private GetAllEnfermedadesUseCase  $getAllEnfermedadesUseCase;
    private DeleteEnfermedadUseCase    $deleteEnfermedadUseCase;
    private EnfermedadWebMapper        $mapper;

    public function __construct(
        CreateEnfermedadUseCase   $createEnfermedadUseCase,
        UpdateEnfermedadUseCase   $updateEnfermedadUseCase,
        GetEnfermedadByIdUseCase  $getEnfermedadByIdUseCase,
        GetAllEnfermedadesUseCase $getAllEnfermedadesUseCase,
        DeleteEnfermedadUseCase   $deleteEnfermedadUseCase,
        EnfermedadWebMapper       $mapper
    ) {
        $this->createEnfermedadUseCase   = $createEnfermedadUseCase;
        $this->updateEnfermedadUseCase   = $updateEnfermedadUseCase;
        $this->getEnfermedadByIdUseCase  = $getEnfermedadByIdUseCase;
        $this->getAllEnfermedadesUseCase  = $getAllEnfermedadesUseCase;
        $this->deleteEnfermedadUseCase   = $deleteEnfermedadUseCase;
        $this->mapper                    = $mapper;
    }

    /**
     * List all diseases.
     *
     * @return EnfermedadResponse[]
     */
    public function index(): array
    {
        $enfermedades = $this->getAllEnfermedadesUseCase->execute(new GetAllEnfermedadesQuery());

        return $this->mapper->fromModelsToResponses($enfermedades);
    }

    /**
     * Show a single disease by id.
     */
    public function show(string $id): EnfermedadResponse
    {
        $query       = $this->mapper->fromIdToGetByIdQuery($id);
        $enfermedad  = $this->getEnfermedadByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($enfermedad);
    }

    /**
     * Create a new disease.
     */
    public function store(CreateEnfermedadWebRequest $request): EnfermedadResponse
    {
        $command    = $this->mapper->fromCreateRequestToCommand($request);
        $enfermedad = $this->createEnfermedadUseCase->execute($command);

        return $this->mapper->fromModelToResponse($enfermedad);
    }

    /**
     * Update an existing disease.
     */
    public function update(UpdateEnfermedadWebRequest $request): EnfermedadResponse
    {
        $command    = $this->mapper->fromUpdateRequestToCommand($request);
        $enfermedad = $this->updateEnfermedadUseCase->execute($command);

        return $this->mapper->fromModelToResponse($enfermedad);
    }

    /**
     * Delete a disease by id.
     */
    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteEnfermedadUseCase->execute($command);
    }
}
