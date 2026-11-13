<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllEnfermedadesQuery.php';
require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface GetAllEnfermedadesUseCase
{
    /**
     * @return EnfermedadModel[]
     */
    public function execute(GetAllEnfermedadesQuery $query): array;
}
