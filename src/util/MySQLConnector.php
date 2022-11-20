<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\util;

use DestiniaPruebaTecnica\exception\DatabaseConnectionException;
use mysqli;
use RuntimeException;
use Throwable;
use function mysqli_report, mysqli_connect, mysqli_close, mysqli_fetch_assoc, mysqli_query;

class MySQLConnector implements DatabaseConnectorInterface
{
    /**
     * @var mysqli|bool|null
     */
    private mysqli|bool|null $resource;

    /**
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $databaseName
     * @param int $port
     */
    public function __construct(
        private string $host,
        private string $username,
        private string $password,
        private string $databaseName,
        private int $port = 3306,
    ) {
    }

    /**
     * @return void
     */
    private function connect(): void {

        $this->resource = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->databaseName,
            $this->port
        );
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        if (!$this->resource) {
            throw new RuntimeException('Database connection failed');
        }
        if (!mysqli_query($this->resource, 'SET NAMES \'utf8\'')) {
            throw new RuntimeException('Cannot configure charset');
        }
    }

    /**
     * @param string $sentence
     * @return array
     * @throws DatabaseConnectionException
     */
    public function read(string $sentence): array
    {
        try {
            $this->connect();
            $result = mysqli_query($this->resource, $sentence);
            $rows = array();
            if ($result !== false) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
            }
            mysqli_close($this->resource);

            return $rows;

        } catch (Throwable $exception) {
            throw new DatabaseConnectionException(
                message: $exception->getMessage()
            );
        }
    }
}