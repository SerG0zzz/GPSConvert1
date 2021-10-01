<?php

namespace Lesson\GpsConverter\Entity;

/**
 * Вышка
 */
final class Bore
{
    private int $number;

    private float $latitude;

    private float $longitude;

    public function __construct(int $number, float $latitude, float $longitude)
    {
        $this->number = $number;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}