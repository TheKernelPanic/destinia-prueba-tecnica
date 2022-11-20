<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\cli;

use DestiniaPruebaTecnica\service\FinderService;
use function fgets, trim;

class AccommodationPlaceFinderCLI
{
    private const SUCCESS_CODE_COLOR = 32;
    private const PRIMARY_CODE_COLOR = 34;
    private const DANGER_CODE_COLOR = 91;
    private const WARNING_CODE_COLOR = 33;
    private const SECONDARY_CODE_COLOR = 37;

    /**
     * @param FinderService $service
     */
    public function __construct(
        private FinderService $service
    ) {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->print(
            text: _('Search for a place of accommodation'),
            colorCode: self::SECONDARY_CODE_COLOR
        );
        $this->print(
            text: _('Enter a search value'),
            colorCode: self::PRIMARY_CODE_COLOR
        );
        $input = $this->readStd();
        while (strlen($input) === 0) {
            $this->print(
                text: 'Please enter a valid value',
                colorCode: self::WARNING_CODE_COLOR
            );
            $input = $this->readStd();
        }

        $collection = $this->service->__invoke($input)->getCollection();
        if (count($collection) === 0) {
            $this->print(
                text: _('No results found'),
                colorCode: self::DANGER_CODE_COLOR
            );
            exit;
        }
        $this->print(
            text: _(sprintf('Found %s results', count($collection))),
            colorCode: self::PRIMARY_CODE_COLOR
        );
        foreach ($collection as $element) {
            $this->print(
                text: $element,
                colorCode: self::SUCCESS_CODE_COLOR
            );
        }
    }

    /**
     * @param string $text
     * @param int $colorCode
     * @return void
     */
    private function print(string $text, int $colorCode): void
    {
        echo "\e[{$colorCode}m{$text}\033[0m\n";
    }

    /**
     * @return string
     */
    private function readStd(): string
    {
        return (string) trim(fgets(STDIN));
    }
}