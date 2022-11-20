<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\domain;

class RoomType
{
    /**
     * @param int $id
     * @param string $description
     */
    public function __construct(
        private int $id,
        private string $description
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}