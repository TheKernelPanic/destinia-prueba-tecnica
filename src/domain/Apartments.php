<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\domain;

use DestiniaPruebaTecnica\util\AccommodationPlaceFormatter;

class Apartments extends AccommodationPlace
{
    public const TYPE = 'APARTMENTS';

    /**
     * @var int
     */
    private int $adultsAllowed;

    /**
     * @var int
     */
    private int $amountAvailable;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->adultsAllowed = (int) $data['adults_allowed'];
        $this->amountAvailable = (int) $data['amount_available'];
    }

    /**
     * @param AccommodationPlaceFormatter $formatter
     * @return void
     */
    public function format(AccommodationPlaceFormatter &$formatter): void
    {
        $formatter->append(
            sprintf(_('Apartments %s'), $this->canonicalName),
            sprintf(_('%s apartments'), (string) $this->amountAvailable),
            sprintf(_('%s adults'), (string) $this->adultsAllowed),
            $this->city,
            $this->province
        );
    }
}