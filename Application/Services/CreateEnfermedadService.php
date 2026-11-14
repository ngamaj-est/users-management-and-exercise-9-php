<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateEnfermedadUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveEnfermedadPort.php';
require_once __DIR__ . '/../Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/Mappers/EnfermedadApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/EnfermedadAlreadyExistsException.php';

final class CreateEnfermedadService implements CreateEnfermedadUseCase
{
    private SaveEnfermedadPort    $saveEnfermedadPort;
    private GetEnfermedadByIdPort $getEnfermedadByIdPort;

    public function __construct(
        SaveEnfermedadPort    $saveEnfermedadPort,
        GetEnfermedadByIdPort $getEnfermedadByIdPort
    ) {
        $this->saveEnfermedadPort    = $saveEnfermedadPort;
        $this->getEnfermedadByIdPort = $getEnfermedadByIdPort;
    }

    public function execute(CreateEnfermedadCommand $command): EnfermedadModel
    {
        $existing = $this->getEnfermedadByIdPort->getById($command->getId());

        if ($existing !== null) {
            throw EnfermedadAlreadyExistsException::becauseNombreAlreadyExists($command->getNombre());
        }

        $enfermedad = EnfermedadApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveEnfermedadPort->save($enfermedad);
    }
}
