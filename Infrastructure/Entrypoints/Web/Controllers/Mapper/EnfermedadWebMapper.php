<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateEnfermedadRequest.php';
require_once __DIR__ . '/../Dto/UpdateEnfermedadRequest.php';
require_once __DIR__ . '/../Dto/EnfermedadResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateEnfermedadCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateEnfermedadCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteEnfermedadCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetEnfermedadByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/EnfermedadModel.php';

final class EnfermedadWebMapper
{
    public function fromCreateRequestToCommand(CreateEnfermedadWebRequest $request): CreateEnfermedadCommand
    {
        return new CreateEnfermedadCommand(
            $request->getId(),
            $request->getNombre(),
            $request->getNombreCientifico(),
            $request->getNivelGravedad(),
            $request->getSintomas(),
            $request->getMedicamentos(),
            $request->getEsContagiosa(),
            $request->getEsCubiertaPorPos(),
            $request->getRequiereIncapacidad()
        );
    }

    public function fromUpdateRequestToCommand(UpdateEnfermedadWebRequest $request): UpdateEnfermedadCommand
    {
        return new UpdateEnfermedadCommand(
            $request->getId(),
            $request->getNombre(),
            $request->getNombreCientifico(),
            $request->getNivelGravedad(),
            $request->getSintomas(),
            $request->getMedicamentos(),
            $request->getEsContagiosa(),
            $request->getEsCubiertaPorPos(),
            $request->getRequiereIncapacidad()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetEnfermedadByIdQuery
    {
        return new GetEnfermedadByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteEnfermedadCommand
    {
        return new DeleteEnfermedadCommand($id);
    }

    public function fromModelToResponse(EnfermedadModel $enfermedad): EnfermedadResponse
    {
        return new EnfermedadResponse(
            $enfermedad->id(),
            $enfermedad->nombre()->value(),
            $enfermedad->nombreCientifico()->value(),
            $enfermedad->nivelGravedad()->value(),
            $enfermedad->sintomas()->value(),
            $enfermedad->medicamentos()->value(),
            $enfermedad->esContagiosa()->value(),
            $enfermedad->esCubiertaPorPos()->value(),
            $enfermedad->requiereIncapacidad()->value()
        );
    }

    /**
     * @param EnfermedadModel[] $enfermedades
     * @return EnfermedadResponse[]
     */
    public function fromModelsToResponses(array $enfermedades): array
    {
        $responses = array();

        foreach ($enfermedades as $enfermedad) {
            $responses[] = $this->fromModelToResponse($enfermedad);
        }

        return $responses;
    }
}
