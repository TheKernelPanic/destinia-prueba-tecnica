<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\service;

use DestiniaPruebaTecnica\domain\AccommodationPlace;
use DestiniaPruebaTecnica\util\AccommodationPlaceFormatter;
use DestiniaPruebaTecnica\util\AccommodationPlacePlainFormatter;
use DestiniaPruebaTecnica\util\InputTextNormalizer;
use function substr;

final class FinderService extends AccommodationPlaceService
{
    private const LENGTH_PREFIX_FOR_MATCH = 3;

    /**
     * @param string $input
     * @return AccommodationPlaceFormatter
     */
    public function __invoke(string $input): AccommodationPlaceFormatter
    {
        $normalized = InputTextNormalizer::normalize($input);

        if (strlen($normalized) > self::LENGTH_PREFIX_FOR_MATCH) {
            $normalized = substr($normalized, 0, self::LENGTH_PREFIX_FOR_MATCH);
        }

        $accommodationPlaces = $this->repository->find(
            criteria: array(
                'slug' => $normalized
            )
        );
        $formatter = new AccommodationPlacePlainFormatter();
        /**
         * @var AccommodationPlace $accommodationPlace
         */
        foreach ($accommodationPlaces as $accommodationPlace) {
            $accommodationPlace->format($formatter);
        }
        return $formatter;
    }
}