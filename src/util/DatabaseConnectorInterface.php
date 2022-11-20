<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\util;

interface DatabaseConnectorInterface
{
    /**
     * @param string $sentence
     * @return array
     */
    public function read(string $sentence): array;
}