<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateEnfermedadUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateEnfermedadPort.php';
require_once __DIR__ . '/../Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/Mappers/EnfermedadApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/EnfermedadNotFoundException.php';

final class UpdateEnfermedadService implements UpdateEnfermedadUseCase
{
    private UpdateEnfermedadPort  $updateEnfermedadPort;
    private GetEnfermedadByIdPort $getEnfermedadByIdPort;

    public function __construct(
        UpdateEnfermedadPort  $updateEnfermedadPort,
        GetEnfermedadByIdPort $getEnfermedadByIdPort
    ) {
        $this->updateEnfermedadPort  = $updateEnfermedadPort;
        $this->getEnfermedadByIdPort = $getEnfermedadByIdPort;
    }

    public function execute(UpdateEnfermedadCommand $command): EnfermedadModel
    {
        $existing = $this->getEnfermedadByIdPort->getById($command->getId());

        if ($existing === null) {
            throw EnfermedadNotFoundException::becauseIdWasNotFound($command->getId());
        }

        $enfermedad = EnfermedadApplicationMapper::fromUpdateCommandToModel($command);

        return $this->updateEnfermedadPort->update($enfermedad);
    }
}
