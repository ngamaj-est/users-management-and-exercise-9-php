<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/EnfermedadNombre.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadNombreCientifico.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadNivelGravedad.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadSintomas.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadMedicamentos.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadEsContagiosa.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadEsCubiertaPorPos.php';
require_once __DIR__ . '/../ValueObjects/EnfermedadRequiereIncapacidad.php';

final class EnfermedadModel
{
    private string $id;
    private EnfermedadNombre $nombre;
    private EnfermedadNombreCientifico $nombreCientifico;
    private EnfermedadNivelGravedad $nivelGravedad;
    private EnfermedadSintomas $sintomas;
    private EnfermedadMedicamentos $medicamentos;
    private EnfermedadEsContagiosa $esContagiosa;
    private EnfermedadEsCubiertaPorPos $esCubiertaPorPos;
    private EnfermedadRequiereIncapacidad $requiereIncapacidad;

    public function __construct(
        string $id,
        EnfermedadNombre $nombre,
        EnfermedadNombreCientifico $nombreCientifico,
        EnfermedadNivelGravedad $nivelGravedad,
        EnfermedadSintomas $sintomas,
        EnfermedadMedicamentos $medicamentos,
        EnfermedadEsContagiosa $esContagiosa,
        EnfermedadEsCubiertaPorPos $esCubiertaPorPos,
        EnfermedadRequiereIncapacidad $requiereIncapacidad
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

    public static function create(
        string $id,
        EnfermedadNombre $nombre,
        EnfermedadNombreCientifico $nombreCientifico,
        EnfermedadNivelGravedad $nivelGravedad,
        EnfermedadSintomas $sintomas,
        EnfermedadMedicamentos $medicamentos,
        EnfermedadEsContagiosa $esContagiosa,
        EnfermedadEsCubiertaPorPos $esCubiertaPorPos,
        EnfermedadRequiereIncapacidad $requiereIncapacidad
    ): self {
        return new self($id, $nombre, $nombreCientifico, $nivelGravedad, $sintomas, $medicamentos, $esContagiosa, $esCubiertaPorPos, $requiereIncapacidad);
    }

    // -------------------------------------------------------------------------
    // Getters
    // -------------------------------------------------------------------------

    public function id(): string                                       { return $this->id; }
    public function nombre(): EnfermedadNombre                         { return $this->nombre; }
    public function nombreCientifico(): EnfermedadNombreCientifico     { return $this->nombreCientifico; }
    public function nivelGravedad(): EnfermedadNivelGravedad           { return $this->nivelGravedad; }
    public function sintomas(): EnfermedadSintomas                     { return $this->sintomas; }
    public function medicamentos(): EnfermedadMedicamentos             { return $this->medicamentos; }
    public function esContagiosa(): EnfermedadEsContagiosa             { return $this->esContagiosa; }
    public function esCubiertaPorPos(): EnfermedadEsCubiertaPorPos     { return $this->esCubiertaPorPos; }
    public function requiereIncapacidad(): EnfermedadRequiereIncapacidad { return $this->requiereIncapacidad; }

    // -------------------------------------------------------------------------
    // Domain behaviour — clone-based immutable mutations
    // -------------------------------------------------------------------------

    /**
     * Returns a shallow clone of this model with one property overridden.
     * All Value Objects are immutable, so a shallow copy is safe.
     */
    private function withProperty(string $property, $newValue): self
    {
        $copy = clone $this;
        $copy->$property = $newValue;
        return $copy;
    }

    public function changeNombre(EnfermedadNombre $v): self                        { return $this->withProperty('nombre', $v); }
    public function changeNombreCientifico(EnfermedadNombreCientifico $v): self    { return $this->withProperty('nombreCientifico', $v); }
    public function changeNivelGravedad(EnfermedadNivelGravedad $v): self          { return $this->withProperty('nivelGravedad', $v); }
    public function changeSintomas(EnfermedadSintomas $v): self                    { return $this->withProperty('sintomas', $v); }
    public function changeMedicamentos(EnfermedadMedicamentos $v): self            { return $this->withProperty('medicamentos', $v); }

    public function markAsContagiosa(): self       { return $this->withProperty('esContagiosa', new EnfermedadEsContagiosa(true)); }
    public function markAsNoContagiosa(): self     { return $this->withProperty('esContagiosa', new EnfermedadEsContagiosa(false)); }

    public function markAsCubiertaPorPos(): self   { return $this->withProperty('esCubiertaPorPos', new EnfermedadEsCubiertaPorPos(true)); }
    public function markAsNoCubiertaPorPos(): self { return $this->withProperty('esCubiertaPorPos', new EnfermedadEsCubiertaPorPos(false)); }

    public function markAsRequiereIncapacidad(): self   { return $this->withProperty('requiereIncapacidad', new EnfermedadRequiereIncapacidad(true)); }
    public function markAsNoRequiereIncapacidad(): self { return $this->withProperty('requiereIncapacidad', new EnfermedadRequiereIncapacidad(false)); }

    // -------------------------------------------------------------------------
    // Serialisation
    // -------------------------------------------------------------------------

    public function toArray(): array
    {
        return [
            'id'                  => $this->id,
            'nombre'              => $this->nombre->value(),
            'nombreCientifico'    => $this->nombreCientifico->value(),
            'nivelGravedad'       => $this->nivelGravedad->value(),
            'sintomas'            => $this->sintomas->value(),
            'medicamentos'        => $this->medicamentos->value(),
            'esContagiosa'        => $this->esContagiosa->value(),
            'esCubiertaPorPos'    => $this->esCubiertaPorPos->value(),
            'requiereIncapacidad' => $this->requiereIncapacidad->value(),
        ];
    }
}
