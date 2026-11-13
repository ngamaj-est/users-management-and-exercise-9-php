<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface UpdateEnfermedadPort
{
    public function update(EnfermedadModel $enfermedad): EnfermedadModel;
}
