<?php
declare(strict_types=1);

use DestiniaPruebaTecnica\domain\AccommodationPlaceRepositoryInterface;
use DestiniaPruebaTecnica\service\FinderService;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \DestiniaPruebaTecnica\service\FinderService
 */
class FinderServiceTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @return void
     */
    public function testRepositoryReceivedRightCriteria(): void
    {
        $expectedCriteria = array(
            'slug' => 'abc'
        );
        $repositoryStub = $this->prophesize(
            AccommodationPlaceRepositoryInterface::class
        );
        $repositoryStub
            ->find(Argument::exact($expectedCriteria))
            ->shouldBeCalledOnce()
            ->willReturn([]);

        $service = new FinderService(
            $repositoryStub->reveal()
        );
        $service(' AbCdE!! ');
    }
}