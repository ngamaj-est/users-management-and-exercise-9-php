<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetEnfermedadByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface GetEnfermedadByIdUseCase
{
    public function execute(GetEnfermedadByIdQuery $query): EnfermedadModel;
}
