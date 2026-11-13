<?php

declare(strict_types=1);

final class EnfermedadResponse
{
    private string $id;
    private string $nombre;
    private string $nombreCientifico;
    private string $nivelGravedad;
    private array  $sintomas;
    private array  $medicamentos;
    private bool   $esContagiosa;
    private bool   $esCubiertaPorPos;
    private bool   $requiereIncapacidad;

    public function __construct(
        string $id,
        string $nombre,
        string $nombreCientifico,
        string $nivelGravedad,
        array  $sintomas,
        array  $medicamentos,
        bool   $esContagiosa,
        bool   $esCubiertaPorPos,
        bool   $requiereIncapacidad
    ) {
        $this->id                  = $id;
        $this->nombre              = $nombre;
        $this->nombreCientifico    = $nombreCientifico;
        $this->nivelGravedad       = $nivelGravedad;
        $this->sintomas            = $sintomas;
        $this->medicamentos        = $medicamentos;
        $this->esContagiosa        = $esContagiosa;
        $this->esCubiertaPorPos    = $esCubiertaPorPos;
        $this->requiereIncapacidad = $requiereIncapacidad;
    }

    public function getId(): string                { return $this->id; }
    public function getNombre(): string            { return $this->nombre; }
    public function getNombreCientifico(): string  { return $this->nombreCientifico; }
    public function getNivelGravedad(): string     { return $this->nivelGravedad; }
    public function getSintomas(): array           { return $this->sintomas; }
    public function getMedicamentos(): array       { return $this->medicamentos; }
    public function getEsContagiosa(): bool        { return $this->esContagiosa; }
    public function getEsCubiertaPorPos(): bool    { return $this->esCubiertaPorPos; }
    public function getRequiereIncapacidad(): bool { return $this->requiereIncapacidad; }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id'                  => $this->id,
            'nombre'              => $this->nombre,
            'nombreCientifico'    => $this->nombreCientifico,
            'nivelGravedad'       => $this->nivelGravedad,
            'sintomas'            => $this->sintomas,
            'medicamentos'        => $this->medicamentos,
            'esContagiosa'        => $this->esContagiosa,
            'esCubiertaPorPos'    => $this->esCubiertaPorPos,
            'requiereIncapacidad' => $this->requiereIncapacidad,
        );
    }
}
