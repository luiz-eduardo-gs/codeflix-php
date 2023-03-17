<?php

namespace Core\Domain\Entity\Trait;

use Exception;

trait MagicProperties
{
    public function __get($property)
    {
        if (!isset($this->{$property})) {
            throw new Exception("Property {$property} not found in " . get_class($this));
        }

        return $this->{$property};
    }
}