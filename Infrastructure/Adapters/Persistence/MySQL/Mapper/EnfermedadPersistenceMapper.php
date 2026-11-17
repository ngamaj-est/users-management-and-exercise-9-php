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
            (string) ($row['id'] ?? ''),
            (string) ($row['nombre'] ?? ''),
            (string) ($row['nombreCientifico'] ?? $row['nombre_cientifico'] ?? ''),
            (string) ($row['nivelGravedad'] ?? $row['nivel_gravedad'] ?? ''),
            (string) ($row['sintomas'] ?? ''),
            (string) ($row['medicamentos'] ?? ''),
            (bool)   ($row['esContagiosa'] ?? $row['es_contagiosa'] ?? false),
            (bool)   ($row['esCubiertaPorPos'] ?? $row['es_cubierta_por_pos'] ?? false),
            (bool)   ($row['requiereIncapacidad'] ?? $row['requiere_incapacidad'] ?? false),
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(EnfermedadEntity $entity): EnfermedadModel
    {
        $parseList = function (string $raw): array {
            $decoded = json_decode($raw, true);
            $items = is_array($decoded) ? $decoded : preg_split('/[\r\n,]+/', $raw);
            $clean = array_values(array_filter(array_map('trim', (array) $items), fn($x) => mb_strlen($x) >= 3));
            return !empty($clean) ? $clean : ['No especificado'];
        };

        $mapNivel = ['LEVE' => 'LEVE', 'MODERADA' => 'MODERADA', 'GRAVE' => 'GRAVE', 'CRITICA' => 'CRITICA', 'CRÍTICA' => 'CRITICA'];
        $nivelGravedad = $mapNivel[strtoupper(trim($entity->nivelGravedad()))] ?? 'LEVE';

        $cientifico = trim($entity->nombreCientifico());
        if (!preg_match('/^[A-ZÁÉÍÓÚÑÜ][a-záéíóúñü]+(\s[a-záéíóúñü]+)+$/', $cientifico)) {
            $words = preg_split('/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+/', $cientifico, -1, PREG_SPLIT_NO_EMPTY);
            $cientifico = count($words) >= 2
                ? ucfirst(mb_strtolower($words[0])) . ' ' . mb_strtolower($words[1])
                : (count($words) === 1 ? ucfirst(mb_strtolower($words[0])) . ' sp' : 'Incertae sedis');
        }

        return EnfermedadModel::create(
            $entity->id(),
            new EnfermedadNombre($entity->nombre()),
            new EnfermedadNombreCientifico($cientifico),
            new EnfermedadNivelGravedad($nivelGravedad),
            new EnfermedadSintomas($parseList($entity->sintomas())),
            new EnfermedadMedicamentos($parseList($entity->medicamentos())),
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
        return array_map(fn($r) => $this->fromRowToModel($r), $rows);
    }
}
