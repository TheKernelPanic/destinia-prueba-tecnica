<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\domain;


use DestiniaPruebaTecnica\util\AccommodationPlaceFormatter;

abstract class AccommodationPlace
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $province;

    /**
     * @var string
     */
    protected string $city;

    /**
     * @var string
     */
    protected string $canonicalName;

    /**
     * @var string
     */
    protected string $slug;

    /**
     * @param array $data
     */
    protected function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->city = $data['city'];
        $this->province = $data['province'];
        $this->canonicalName = $data['canonical_name'];
        $this->slug = $data['slug'];
    }

    /**
     * @param AccommodationPlaceFormatter $formatter
     * @return void
     */
    abstract public function format(AccommodationPlaceFormatter &$formatter): void;
}