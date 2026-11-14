<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetEnfermedadByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetEnfermedadByIdPort.php';
require_once __DIR__ . '/Mappers/EnfermedadApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/EnfermedadNotFoundException.php';

final class GetEnfermedadByIdService implements GetEnfermedadByIdUseCase
{
    private GetEnfermedadByIdPort $getEnfermedadByIdPort;

    public function __construct(GetEnfermedadByIdPort $getEnfermedadByIdPort)
    {
        $this->getEnfermedadByIdPort = $getEnfermedadByIdPort;
    }

    public function execute(GetEnfermedadByIdQuery $query): EnfermedadModel
    {
        $id          = EnfermedadApplicationMapper::fromGetByIdQueryToId($query);
        $enfermedad  = $this->getEnfermedadByIdPort->getById($id);

        if ($enfermedad === null) {
            throw EnfermedadNotFoundException::becauseIdWasNotFound($id);
        }

        return $enfermedad;
    }
}
