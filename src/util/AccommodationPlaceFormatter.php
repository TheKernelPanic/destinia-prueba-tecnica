<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\util;

interface AccommodationPlaceFormatter
{
    /**
     * @param string ...$fields
     * @return void
     */
    public function append(string ...$fields): void;

    /**
     * @return array
     */
    public function getCollection(): array;
}