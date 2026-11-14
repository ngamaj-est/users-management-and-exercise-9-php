<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllEnfermedadesUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllEnfermedadesPort.php';

final class GetAllEnfermedadesService implements GetAllEnfermedadesUseCase
{
    private GetAllEnfermedadesPort $getAllEnfermedadesPort;

    public function __construct(GetAllEnfermedadesPort $getAllEnfermedadesPort)
    {
        $this->getAllEnfermedadesPort = $getAllEnfermedadesPort;
    }

    /**
     * @return EnfermedadModel[]
     */
    public function execute(GetAllEnfermedadesQuery $query): array
    {
        return $this->getAllEnfermedadesPort->getAll();
    }
}
