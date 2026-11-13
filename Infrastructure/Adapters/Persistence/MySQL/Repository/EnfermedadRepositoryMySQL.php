<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveEnfermedadPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateEnfermedadPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllEnfermedadesPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteEnfermedadPort.php';

require_once __DIR__ . '/../Mapper/EnfermedadPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/EnfermedadModel.php';
require_once __DIR__ . '/../../../../../Domain/Exceptions/EnfermedadNotFoundException.php';

final class EnfermedadRepositoryMySQL implements
    SaveEnfermedadPort,
    UpdateEnfermedadPort,
    GetEnfermedadByIdPort,
    GetAllEnfermedadesPort,
    DeleteEnfermedadPort
{
    private PDO $pdo;
    private EnfermedadPersistenceMapper $mapper;

    public function __construct(PDO $pdo, EnfermedadPersistenceMapper $mapper)
    {
        $this->pdo    = $pdo;
        $this->mapper = $mapper;
    }

    public function save(EnfermedadModel $enfermedad): EnfermedadModel
    {
        $dto = $this->mapper->fromModelToDto($enfermedad);

        $sql = ' INSERT INTO enfermedades (id,nombre, nombre_cientifico,
                nivel_gravedad,sintomas,medicamentos,es_contagiosa,
                es_cubierta_por_pos,requiere_incapacidad,created_at,updated_at) 
                VALUES (:id,:nombre,:nombre_cientifico,:nivel_gravedad,
                :sintomas,:medicamentos,:es_contagiosa,:es_cubierta_por_pos,:requiere_incapacidad,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id'                   => $dto->id(),
            ':nombre'               => $dto->nombre(),
            ':nombre_cientifico'    => $dto->nombreCientifico(),
            ':nivel_gravedad'       => $dto->nivelGravedad(),
            ':sintomas'             => $dto->sintomas(),
            ':medicamentos'         => $dto->medicamentos(),
            ':es_contagiosa'        => (int) $dto->esContagiosa(),
            ':es_cubierta_por_pos'  => (int) $dto->esCubiertaPorPos(),
            ':requiere_incapacidad' => (int) $dto->requiereIncapacidad(),
        ));

        $saved = $this->getById($dto->id());

        if ($saved === null) {
            throw new RuntimeException('The disease could not be recovered after save.');
        }

        return $saved;
    }

    public function update(EnfermedadModel $enfermedad): EnfermedadModel
    {
        $dto = $this->mapper->fromModelToDto($enfermedad);

        $sql = '
            UPDATE enfermedades
               SET nombre               = :nombre,
                   nombre_cientifico    = :nombre_cientifico,
                   nivel_gravedad       = :nivel_gravedad,
                   sintomas             = :sintomas,
                   medicamentos         = :medicamentos,
                   es_contagiosa        = :es_contagiosa,
                   es_cubierta_por_pos  = :es_cubierta_por_pos,
                   requiere_incapacidad = :requiere_incapacidad,
                   updated_at           = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id'                   => $dto->id(),
            ':nombre'               => $dto->nombre(),
            ':nombre_cientifico'    => $dto->nombreCientifico(),
            ':nivel_gravedad'       => $dto->nivelGravedad(),
            ':sintomas'             => $dto->sintomas(),
            ':medicamentos'         => $dto->medicamentos(),
            ':es_contagiosa'        => (int) $dto->esContagiosa(),
            ':es_cubierta_por_pos'  => (int) $dto->esCubiertaPorPos(),
            ':requiere_incapacidad' => (int) $dto->requiereIncapacidad(),
        ));

        $updated = $this->getById($dto->id());

        if ($updated === null) {
            throw new RuntimeException('The disease could not be recovered after update.');
        }

        return $updated;
    }

    public function getById(string $id): ?EnfermedadModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                nombre_cientifico,
                nivel_gravedad,
                sintomas,
                medicamentos,
                es_contagiosa,
                es_cubierta_por_pos,
                requiere_incapacidad,
                created_at,
                updated_at
            FROM enfermedades
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $id));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return EnfermedadModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                nombre,
                nombre_cientifico,
                nivel_gravedad,
                sintomas,
                medicamentos,
                es_contagiosa,
                es_cubierta_por_pos,
                requiere_incapacidad,
                created_at,
                updated_at
            FROM enfermedades
            ORDER BY nombre ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows      = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(string $id): void
    {
        $sql = 'DELETE FROM enfermedades WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $id));
    }
}
