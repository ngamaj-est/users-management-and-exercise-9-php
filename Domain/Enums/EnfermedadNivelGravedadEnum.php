<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadNivelGravedadException.php';

class EnfermedadNivelGravedadEnum
{
    const LEVE     = 'LEVE';
    const MODERADA = 'MODERADA';
    const GRAVE    = 'GRAVE';
    const CRITICA  = 'CRITICA';

    public static function values()
    {
        return array(
            self::LEVE,
            self::MODERADA,
            self::GRAVE,
            self::CRITICA
        );
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidEnfermedadNivelGravedadException::becauseValueIsInvalid($value);
        }
    }
}
