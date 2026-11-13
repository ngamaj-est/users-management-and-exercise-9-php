<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateEnfermedadCommand.php';
require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface CreateEnfermedadUseCase
{
    public function execute(CreateEnfermedadCommand $command): EnfermedadModel;
}
