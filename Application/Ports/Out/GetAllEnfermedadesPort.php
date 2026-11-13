<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface GetAllEnfermedadesPort
{
    /**
     * @return EnfermedadModel[]
     */
    public function getAll(): array;
}
