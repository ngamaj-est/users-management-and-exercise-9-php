<?php

declare(strict_types=1);

final class EnfermedadPersistenceDto
{
    private string $id;
    private string $nombre;
    private string $nombreCientifico;
    private string $nivelGravedad;
    private string $sintomas;          // JSON-encoded
    private string $medicamentos;      // JSON-encoded
    private bool   $esContagiosa;
    private bool   $esCubiertaPorPos;
    private bool   $requiereIncapacidad;

    public function __construct(
        string $id,
        string $nombre,
        string $nombreCientifico,
        string $nivelGravedad,
        string $sintomas,
        string $medicamentos,
        bool   $esContagiosa,
        bool   $esCubiertaPorPos,
        bool   $requiereIncapacidad
    ) {
        $this->id                  = trim($id);
        $this->nombre              = trim($nombre);
        $this->nombreCientifico    = trim($nombreCientifico);
        $this->nivelGravedad       = trim($nivelGravedad);
        $this->sintomas            = $sintomas;
        $this->medicamentos        = $medicamentos;
        $this->esContagiosa        = $esContagiosa;
        $this->esCubiertaPorPos    = $esCubiertaPorPos;
        $this->requiereIncapacidad = $requiereIncapacidad;
    }

    public function id(): string                { return $this->id; }
    public function nombre(): string            { return $this->nombre; }
    public function nombreCientifico(): string  { return $this->nombreCientifico; }
    public function nivelGravedad(): string     { return $this->nivelGravedad; }
    public function sintomas(): string          { return $this->sintomas; }
    public function medicamentos(): string      { return $this->medicamentos; }
    public function esContagiosa(): bool        { return $this->esContagiosa; }
    public function esCubiertaPorPos(): bool    { return $this->esCubiertaPorPos; }
    public function requiereIncapacidad(): bool { return $this->requiereIncapacidad; }
}
