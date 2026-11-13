<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteEnfermedadCommand.php';

interface DeleteEnfermedadUseCase
{
    public function execute(DeleteEnfermedadCommand $command): void;
}
