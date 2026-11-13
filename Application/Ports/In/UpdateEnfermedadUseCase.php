<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateEnfermedadCommand.php';
require_once __DIR__ . '/../../../Domain/Models/EnfermedadModel.php';

interface UpdateEnfermedadUseCase
{
    public function execute(UpdateEnfermedadCommand $command): EnfermedadModel;
}
