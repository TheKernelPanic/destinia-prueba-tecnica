<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\domain;

interface AccommodationPlaceRepositoryInterface
{
    /**
     * @param array $criteria
     * @return array
     */
    public function find(array $criteria): array;
}