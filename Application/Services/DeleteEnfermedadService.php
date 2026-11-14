<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteEnfermedadUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteEnfermedadPort.php';
require_once __DIR__ . '/../Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/Mappers/EnfermedadApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/EnfermedadNotFoundException.php';

final class DeleteEnfermedadService implements DeleteEnfermedadUseCase
{
    private DeleteEnfermedadPort  $deleteEnfermedadPort;
    private GetEnfermedadByIdPort $getEnfermedadByIdPort;

    public function __construct(
        DeleteEnfermedadPort  $deleteEnfermedadPort,
        GetEnfermedadByIdPort $getEnfermedadByIdPort
    ) {
        $this->deleteEnfermedadPort  = $deleteEnfermedadPort;
        $this->getEnfermedadByIdPort = $getEnfermedadByIdPort;
    }

    public function execute(DeleteEnfermedadCommand $command): void
    {
        $id         = EnfermedadApplicationMapper::fromDeleteCommandToId($command);
        $enfermedad = $this->getEnfermedadByIdPort->getById($id);

        if ($enfermedad === null) {
            throw EnfermedadNotFoundException::becauseIdWasNotFound($id);
        }

        $this->deleteEnfermedadPort->delete($id);
    }
}
