<?php

class InvalidEnfermedadEsCubiertaPorPosException extends InvalidArgumentException
{
    public static function becauseValueIsNotBoolean($value)
    {
        return new self('The POS coverage flag (esCubiertaPorPos) must be a boolean value, got: ' . gettype($value));
    }

    public static function becauseValueIsNull()
    {
        return new self('The POS coverage flag (esCubiertaPorPos) must not be null.');
    }
}
