<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\domain;

use DestiniaPruebaTecnica\util\AccommodationPlaceFormatter;

class Hotel extends AccommodationPlace
{
    public const TYPE = 'HOTEL';

    /**
     * @var RoomType
     */
    private RoomType $roomType;

    /**
     * @var int
     */
    private int $starsNumber;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->starsNumber = (int) $data['stars_number'];
        $this->roomType = new RoomType(
            (int) $data['room_type_id'],
            $data['description']
        );
    }

    /**
     * @param AccommodationPlaceFormatter $formatter
     * @return void
     */
    public function format(AccommodationPlaceFormatter &$formatter): void
    {
        $formatter->append(
            sprintf(_('Hotel %s'), $this->canonicalName),
            sprintf(_('%s stars'), (string) $this->starsNumber),
            _($this->roomType->getDescription()),
            $this->city,
            $this->province
        );
    }
}