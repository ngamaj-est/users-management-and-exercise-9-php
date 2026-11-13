<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateEnfermedadCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateEnfermedadCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteEnfermedadCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetEnfermedadByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadNombre.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadNombreCientifico.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadNivelGravedad.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadSintomas.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadMedicamentos.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadEsContagiosa.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadEsCubiertaPorPos.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/EnfermedadRequiereIncapacidad.php';

final class EnfermedadApplicationMapper
{
    public static function fromCreateCommandToModel(CreateEnfermedadCommand $command): EnfermedadModel
    {
        return EnfermedadModel::create(
            $command->getId(),
            new EnfermedadNombre($command->getNombre()),
            new EnfermedadNombreCientifico($command->getNombreCientifico()),
            new EnfermedadNivelGravedad($command->getNivelGravedad()),
            new EnfermedadSintomas($command->getSintomas()),
            new EnfermedadMedicamentos($command->getMedicamentos()),
            new EnfermedadEsContagiosa($command->getEsContagiosa()),
            new EnfermedadEsCubiertaPorPos($command->getEsCubiertaPorPos()),
            new EnfermedadRequiereIncapacidad($command->getRequiereIncapacidad())
        );
    }

    public static function fromUpdateCommandToModel(UpdateEnfermedadCommand $command): EnfermedadModel
    {
        return EnfermedadModel::create(
            $command->getId(),
            new EnfermedadNombre($command->getNombre()),
            new EnfermedadNombreCientifico($command->getNombreCientifico()),
            new EnfermedadNivelGravedad($command->getNivelGravedad()),
            new EnfermedadSintomas($command->getSintomas()),
            new EnfermedadMedicamentos($command->getMedicamentos()),
            new EnfermedadEsContagiosa($command->getEsContagiosa()),
            new EnfermedadEsCubiertaPorPos($command->getEsCubiertaPorPos()),
            new EnfermedadRequiereIncapacidad($command->getRequiereIncapacidad())
        );
    }

    public static function fromGetByIdQueryToId(GetEnfermedadByIdQuery $query): string
    {
        return $query->getId();
    }

    public static function fromDeleteCommandToId(DeleteEnfermedadCommand $command): string
    {
        return $command->getId();
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromModelToArray(EnfermedadModel $enfermedad): array
    {
        return $enfermedad->toArray();
    }

    /**
     * @param EnfermedadModel[] $enfermedades
     * @return array<int, array<string, mixed>>
     */
    public static function fromModelsToArray(array $enfermedades): array
    {
        $result = [];
        foreach ($enfermedades as $enfermedad) {
            $result[] = self::fromModelToArray($enfermedad);
        }
        return $result;
    }
}
