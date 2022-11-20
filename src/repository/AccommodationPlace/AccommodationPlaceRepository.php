<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\repository\AccommodationPlace;

use DestiniaPruebaTecnica\domain\AccommodationPlaceRepositoryInterface;
use DestiniaPruebaTecnica\domain\Apartments;
use DestiniaPruebaTecnica\domain\Hotel;
use DestiniaPruebaTecnica\repository\Repository;
use function array_key_exists;

class AccommodationPlaceRepository extends Repository implements AccommodationPlaceRepositoryInterface
{
    private array $entitiesMap = array(
        Apartments::TYPE => Apartments::class,
        Hotel::TYPE => Hotel::class
    );

    /**
     * @param array $criteria
     * @return array
     */
    public function find(array $criteria): array
    {
        $slug = $criteria['slug'];

        /**
         * TODO: Potential performance issue, in the future it is necessary to paginate
         * record amounts using the limit
         */
        $sentence = "SELECT
            accommodation_place.*,
            apartments.adults_allowed,
            apartments.amount_available,
            hotel.stars_number,
            hotel.room_type_id,
            room_type.description
        FROM accommodation_place
            LEFT JOIN apartments ON accommodation_place.id = apartments.id
            LEFT JOIN hotel ON accommodation_place.id = hotel.id
            LEFT JOIN room_type ON hotel.room_type_id = room_type.id
        WHERE
            accommodation_place.slug LIKE '{$slug}%' ORDER BY id DESC";

        $results = $this->connector->read($sentence);

        return $this->mapResults($results);
    }

    /**
     * @param array $rows
     * @return array
     */
    private function mapResults(array $rows): array
    {
        $entities = array();
        foreach ($rows as $row) {

            if (!array_key_exists($row['type'], $this->entitiesMap)) {
                continue;
            }
            $entities[] = new $this->entitiesMap[$row['type']]($row);
        }
        return $entities;
    }
}