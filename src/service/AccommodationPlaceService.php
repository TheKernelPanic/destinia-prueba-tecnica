<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\service;

use DestiniaPruebaTecnica\domain\AccommodationPlaceRepositoryInterface;

abstract class AccommodationPlaceService
{
    /**
     * @param AccommodationPlaceRepositoryInterface $repository
     */
    public function __construct(
        protected AccommodationPlaceRepositoryInterface $repository
    ) {
    }
}