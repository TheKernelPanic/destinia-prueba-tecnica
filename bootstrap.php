<?php
declare(strict_types=1);

use DestiniaPruebaTecnica\repository\AccommodationPlace\AccommodationPlaceRepository;
use DestiniaPruebaTecnica\service\FinderService;
use DestiniaPruebaTecnica\util\MySQLConnector;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

(new Dotenv())->load(__DIR__ . '/.env');

if ($_ENV['DEBUG_MODE'] === 'dev') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

/**
 * Locale configuration
 */
setlocale(LC_ALL, $_ENV['LANGUAGE']);
bindtextdomain('messages', __DIR__ . '/locale');
textdomain('messages');

/**
 * Initialize application service & dependencies
 */
$repository = new AccommodationPlaceRepository(
    connector: new MySQLConnector(
        host: $_ENV['DATABASE_HOST'],
        username: $_ENV['DATABASE_USER'],
        password: $_ENV['DATABASE_PASSWORD'],
        databaseName: $_ENV['DATABASE_NAME']
    )
);
return new FinderService(
    repository: $repository
);