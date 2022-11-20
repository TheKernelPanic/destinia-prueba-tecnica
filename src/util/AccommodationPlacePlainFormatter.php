<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\util;

use function implode;

class AccommodationPlacePlainFormatter implements AccommodationPlaceFormatter
{
    /**
     * @var array
     */
    private array $collection = [];

    /**
     * @param string ...$fields
     * @return void
     */
    public function append(string ...$fields): void
    {
        $this->collection[] = implode(', ', $fields);
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
}