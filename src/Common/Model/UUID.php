<?php

namespace App\model;

class UUID
{
    /**
     * @var string
     */
    private string $value;

    /**
     * UUID constructor.
     * @param string|null $value
     */
    public function __construct(?string $value=null)
    {
        $this->value = $value ?? uniqid();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(UUID $other): bool
    {
        return $other->getValue() === $this->value;
    }
}
