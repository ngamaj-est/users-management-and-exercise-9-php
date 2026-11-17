<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveEnfermedadPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateEnfermedadPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllEnfermedadesPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteEnfermedadPort.php';
require_once __DIR__ . '/../Mapper/EnfermedadPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/EnfermedadModel.php';

final class EnfermedadRepositoryMySQL implements
    SaveEnfermedadPort,
    UpdateEnfermedadPort,
    GetEnfermedadByIdPort,
    GetAllEnfermedadesPort,
    DeleteEnfermedadPort
{
    private PDO $pdo;
    private EnfermedadPersistenceMapper $mapper;
    private ?string $table = null;

    public function __construct(PDO $pdo, EnfermedadPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    private function table(): string
    {
        if ($this->table === null) {
            try {
                $this->pdo->query('SELECT 1 FROM Enfermedades LIMIT 1');
                $this->table = 'Enfermedades';
            } catch (Throwable $e) {
                $this->table = 'enfermedades';
            }
        }
        return $this->table;
    }

    private function params($dto): array
    {
        return [
            ':nombre'               => $dto->nombre(),
            ':nombreCientifico'    => $dto->nombreCientifico(),
            ':nivelGravedad'       => $dto->nivelGravedad(),
            ':sintomas'             => $dto->sintomas(),
            ':medicamentos'         => $dto->medicamentos(),
            ':esContagiosa'        => (int) $dto->esContagiosa(),
            ':esCubiertaPorPos'    => (int) $dto->esCubiertaPorPos(),
            ':requiereIncapacidad' => (int) $dto->requiereIncapacidad(),
        ];
    }

    public function save(EnfermedadModel $enfermedad): EnfermedadModel
    {
        $t = $this->table();
        $dto = $this->mapper->fromModelToDto($enfermedad);
        $p = $this->params($dto);

        try {
            $stmt = $this->pdo->prepare("INSERT INTO {$t} (nombre, nombreCientifico, nivelGravedad, sintomas, medicamentos, esContagiosa, esCubiertaPorPos, requiereIncapacidad) VALUES (:nombre, :nombreCientifico, :nivelGravedad, :sintomas, :medicamentos, :esContagiosa, :esCubiertaPorPos, :requiereIncapacidad)");
            $stmt->execute($p);
        } catch (Throwable $e) {
            $p[':id'] = $dto->id();
            $stmt = $this->pdo->prepare("INSERT INTO {$t} (id, nombre, nombre_cientifico, nivel_gravedad, sintomas, medicamentos, es_contagiosa, es_cubierta_por_pos, requiere_incapacidad) VALUES (:id, :nombre, :nombreCientifico, :nivelGravedad, :sintomas, :medicamentos, :esContagiosa, :esCubiertaPorPos, :requiereIncapacidad)");
            $stmt->execute($p);
        }

        $id = $this->pdo->lastInsertId() ?: $dto->id();
        return $this->getById((string) $id) ?? $enfermedad;
    }

    public function update(EnfermedadModel $enfermedad): EnfermedadModel
    {
        $t = $this->table();
        $dto = $this->mapper->fromModelToDto($enfermedad);
        $p = $this->params($dto);
        $p[':id'] = $dto->id();

        try {
            $stmt = $this->pdo->prepare("UPDATE {$t} SET nombre = :nombre, nombreCientifico = :nombreCientifico, nivelGravedad = :nivelGravedad, sintomas = :sintomas, medicamentos = :medicamentos, esContagiosa = :esContagiosa, esCubiertaPorPos = :esCubiertaPorPos, requiereIncapacidad = :requiereIncapacidad WHERE id = :id");
            $stmt->execute($p);
        } catch (Throwable $e) {
            $stmt = $this->pdo->prepare("UPDATE {$t} SET nombre = :nombre, nombre_cientifico = :nombreCientifico, nivel_gravedad = :nivelGravedad, sintomas = :sintomas, medicamentos = :medicamentos, es_contagiosa = :esContagiosa, es_cubierta_por_pos = :esCubiertaPorPos, requiere_incapacidad = :requiereIncapacidad WHERE id = :id");
            $stmt->execute($p);
        }

        return $this->getById($dto->id()) ?? $enfermedad;
    }

    public function getById(string $id): ?EnfermedadModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table()} WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ? $this->mapper->fromRowToModel($row) : null;
    }

    public function getAll(): array
    {
        $rows = $this->pdo->query("SELECT * FROM {$this->table()} ORDER BY nombre ASC")->fetchAll();
        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(string $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table()} WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
