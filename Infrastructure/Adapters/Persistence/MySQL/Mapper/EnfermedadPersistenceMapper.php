<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/EnfermedadPersistenceDto.php';
require_once __DIR__ . '/../Entity/EnfermedadEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/EnfermedadModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadNombre.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadNombreCientifico.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadNivelGravedad.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadSintomas.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadMedicamentos.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadEsContagiosa.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadEsCubiertaPorPos.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/EnfermedadRequiereIncapacidad.php';

final class EnfermedadPersistenceMapper
{
    public function fromModelToDto(EnfermedadModel $enfermedad): EnfermedadPersistenceDto
    {
        return new EnfermedadPersistenceDto(
            $enfermedad->id(),
            $enfermedad->nombre()->value(),
            $enfermedad->nombreCientifico()->value(),
            $enfermedad->nivelGravedad()->value(),
            json_encode($enfermedad->sintomas()->value()),
            json_encode($enfermedad->medicamentos()->value()),
            $enfermedad->esContagiosa()->value(),
            $enfermedad->esCubiertaPorPos()->value(),
            $enfermedad->requiereIncapacidad()->value()
        );
    }

    public function fromDtoToEntity(EnfermedadPersistenceDto $dto): EnfermedadEntity
    {
        return new EnfermedadEntity(
            $dto->id(),
            $dto->nombre(),
            $dto->nombreCientifico(),
            $dto->nivelGravedad(),
            $dto->sintomas(),
            $dto->medicamentos(),
            $dto->esContagiosa(),
            $dto->esCubiertaPorPos(),
            $dto->requiereIncapacidad()
        );
    }

    public function fromRowToEntity(array $row): EnfermedadEntity
    {
        return new EnfermedadEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (string) $row['nombre_cientifico'],
            (string) $row['nivel_gravedad'],
            (string) $row['sintomas'],
            (string) $row['medicamentos'],
            (bool)   $row['es_contagiosa'],
            (bool)   $row['es_cubierta_por_pos'],
            (bool)   $row['requiere_incapacidad'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(EnfermedadEntity $entity): EnfermedadModel
    {
        return EnfermedadModel::create(
            $entity->id(),
            new EnfermedadNombre($entity->nombre()),
            new EnfermedadNombreCientifico($entity->nombreCientifico()),
            new EnfermedadNivelGravedad($entity->nivelGravedad()),
            new EnfermedadSintomas(json_decode($entity->sintomas(), true)),
            new EnfermedadMedicamentos(json_decode($entity->medicamentos(), true)),
            new EnfermedadEsContagiosa($entity->esContagiosa()),
            new EnfermedadEsCubiertaPorPos($entity->esCubiertaPorPos()),
            new EnfermedadRequiereIncapacidad($entity->requiereIncapacidad())
        );
    }

    public function fromRowToModel(array $row): EnfermedadModel
    {
        return $this->fromEntityToModel($this->fromRowToEntity($row));
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return EnfermedadModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();
        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }
        return $models;
    }
}
