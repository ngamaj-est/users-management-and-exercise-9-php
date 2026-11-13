<?php

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/EnfermedadModel.php';

class EnfermedadCreatedDomainEvent extends DomainEvent
{
    private EnfermedadModel $enfermedad;

    public function __construct(EnfermedadModel $enfermedad)
    {
        parent::__construct('enfermedad.created');
        $this->enfermedad = $enfermedad;
    }

    public function enfermedad(): EnfermedadModel
    {
        return $this->enfermedad;
    }

    public function payload(): array
    {
        return $this->enfermedad->toArray();
    }
}
