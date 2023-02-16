<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;
use App\Domain\Station\StationService;
use App\Action\StationService as StationAction;
use App\Tests\UtilsTest;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class StationServiceTest extends TestCase
{
    use UtilsTest;

    public function testGetStations(): void
    {
        $stations = $this->dataproviderStations();
        $mockStationAction = $this->getMockStations($stations);
        $stationD = new StationService($mockStationAction, $this->mockRequestStack());
        $this->assertEquals(2, count($stationD->getStations()));
    }

    public function testGetStationsWhenNotFound(): void
    {
        $mockStationAction = $this->getMockStationsEmpty();
        $stationD = new StationService($mockStationAction, $this->mockRequestStack());
        $this->assertEquals(0, count($stationD->getStations()));
    }

    private function getMockStations(array $stations): StationAction
    {
        $mock = $this->createConfiguredMock(StationAction::class, ['getStationsAction' => $stations]);
        return $mock;
    }

    private function getMockStationsEmpty(): StationAction
    {
        $mock = $this->createConfiguredMock(StationAction::class, ['getStationsAction' => []]);
        return $mock;
    }


    private function mockRequestStack(): RequestStack{
        $mockRequestStack = $this->createConfiguredMock(RequestStack::class, ['getCurrentRequest' => $this->mockRequest()]);
        return $mockRequestStack;
    }

    private function mockRequest(): Request{
        $mockObRequest = $this->createConfiguredMock(Request::class, []);
        $mockObRequest->query = $this->mockInputBag();
        return $mockObRequest;
    }

    private function mockInputBag(): InputBag{
        $mockInputBag = $this->createConfiguredMock(InputBag::class, ['get' => 'test']);
        return $mockInputBag;
    }
}
