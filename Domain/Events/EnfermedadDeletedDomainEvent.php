<?php

require_once __DIR__ . '/EventDomain.php';

class EnfermedadDeletedDomainEvent extends DomainEvent
{
    private string $enfermedadId;

    public function __construct(string $enfermedadId)
    {
        parent::__construct('enfermedad.deleted');
        $this->enfermedadId = $enfermedadId;
    }

    public function enfermedadId(): string
    {
        return $this->enfermedadId;
    }

    public function payload(): array
    {
        return ['id' => $this->enfermedadId];
    }
}
