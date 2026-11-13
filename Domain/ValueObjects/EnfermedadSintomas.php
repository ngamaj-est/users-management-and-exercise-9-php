<?php

require_once __DIR__ . '/../Exceptions/InvalidEnfermedadSintomasException.php';

class EnfermedadSintomas
{
    const MIN_SINTOMA_LENGTH = 3;

    private $value;

    public function __construct($value)
    {
        if (empty($value)) {
            throw InvalidEnfermedadSintomasException::becauseValueIsEmpty();
        }

        if (!is_array($value)) {
            $value = array($value);
        }

        $normalized = array();
        foreach ($value as $sintoma) {
            $item = trim((string) $sintoma);
            if ($item === '') {
                continue;
            }
            if (mb_strlen($item) < self::MIN_SINTOMA_LENGTH) {
                throw InvalidEnfermedadSintomasException::becauseSintomaIsTooShort(self::MIN_SINTOMA_LENGTH);
            }
            $normalized[] = $item;
        }

        if (count($normalized) === 0) {
            throw InvalidEnfermedadSintomasException::becauseListIsEmpty();
        }

        $this->value = $normalized;
    }

    public function value()
    {
        return $this->value;
    }

    public function count()
    {
        return count($this->value);
    }

    public function contains($sintoma)
    {
        return in_array(trim((string) $sintoma), $this->value, true);
    }

    public function equals(EnfermedadSintomas $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return implode(', ', $this->value);
    }
}
