<?php

namespace Lesson\GpsConverter\Entity;

/**
 * Локация
 */
final class Location
{
    private string $name;

    private array $bores;

    public function __construct(string $name, Bore ...$bores)
    {
        $this->name = $name;
        $this->bores = $bores;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Bore[]
     */
    public function getBores(): array
    {
        return $this->bores;
    }
}