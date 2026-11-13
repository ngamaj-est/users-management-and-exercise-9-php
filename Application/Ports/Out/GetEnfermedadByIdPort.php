<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface GetEnfermedadByIdPort
{
    public function getById(string $id): ?EnfermedadModel;
}
