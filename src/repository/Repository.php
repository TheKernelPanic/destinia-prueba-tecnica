<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\repository;

use DestiniaPruebaTecnica\util\DatabaseConnectorInterface;

abstract class Repository
{
    /**
     * @param DatabaseConnectorInterface $connector
     */
    public function __construct(
        protected DatabaseConnectorInterface $connector
    ) {
    }
}