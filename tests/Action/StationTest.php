<?php

namespace App\Tests\Action;

use PHPUnit\Framework\TestCase;
use App\Domain\Entity\Station;
use App\Action\StationAction;
use App\Repository\StationRepository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use DG\BypassFinals;
use App\Tests\UtilsTest;
use App\Action\StationRepo;


class StationTest extends TestCase
{
    use UtilsTest;
    const  NUMBER_STATION = 2;

    protected function setUp(): void
    {
        BypassFinals::enable();
    }

    public function testGetStationAction(): void
    {
        $this->removeCachedStations();
        $stations = $this->dataproviderStations();
        $mockStationRepo = $this->createConfiguredMock(StationRepo::class, ['getAllStations' => $stations]);
        $action = new StationAction($mockStationRepo);
        $this->assertEquals(self::NUMBER_STATION, count($action->stationsAtPosition($this->mockRequestStack())));
        $this->assertEquals('App\Domain\Entity\Station', get_class($action->stationsAtPosition($this->mockRequestStack())[0]));
        $this->assertEquals('amenageur1', $action->stationsAtPosition($this->mockRequestStack())[0]->getAmenageur());
        $this->assertEquals('operateur1', $action->stationsAtPosition($this->mockRequestStack())[0]->getOperateur());
        $this->assertEquals('amenageur2', $action->stationsAtPosition($this->mockRequestStack())[1]->getAmenageur());
        $this->assertEquals('operateur2', $action->stationsAtPosition($this->mockRequestStack())[1]->getOperateur());
        $this->removeCachedStations();
    }

    public function testGetLatLonIfDataFound(): void
    {
        $stations = $this->dataproviderStations();
        $inputBag =  $this->getMockBuilder(InputBag::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $inputBag->method('get')->willReturn($stations);
        $mockObRequest = $this->createConfiguredMock(Request::class, []);
        $mockObRequest->query = $inputBag;
        $mockRequestStack = $this->createConfiguredMock(RequestStack::class, ['getCurrentRequest' => $this->mockRequest()]);
        $mockStationRepo = $this->createConfiguredMock(StationRepo::class, ['getStationsByFilters' => []]);

        $action = new StationAction($mockStationRepo);

        $this->assertEquals(count($stations), count($action->getLatLon($mockRequestStack)));
    }

    public function testGetLatLonIfDataNotFound(): void
    {
        $inputBag = $this->createConfiguredMock(InputBag::class, ['get' => '']);
        $mockObRequest = $this->createConfiguredMock(Request::class, []);
        $mockObRequest->query = $inputBag;
        $mockRequestStack = $this->createConfiguredMock(RequestStack::class, ['getCurrentRequest' => $mockObRequest]);
        $mockStationRepo = $this->createConfiguredMock(StationRepo::class, ['getStationsByFilters' => []]);

        $action = new StationAction($mockStationRepo);
        $this->assertEquals(0, count($action->getLatLon($mockRequestStack)));
    }

    private function dataproviderStations(): array
    {
        $stations = [];
        $station1 = new Station;
        $station1->setAmenageur("amenageur1");
        $station1->setOperateur("operateur1");
        $station2 = new Station;
        $station2->setAmenageur("amenageur2");
        $station2->setOperateur("operateur2");
        array_push($stations, $station1, $station2);
        return $stations;
    }

    private function removeCachedStations(): void
    {
        $cache = new FilesystemAdapter();
        $cache->delete('stations');
    }

    private function mockRequestStack(): RequestStack
    {
        $mockRequestStack = $this->createConfiguredMock(RequestStack::class, ['getCurrentRequest' => $this->mockRequest()]);
        return $mockRequestStack;
    }

    private function mockRequest(): Request
    {
        $mockObRequest = $this->createConfiguredMock(Request::class, []);
        $mockObRequest->query = $this->mockInputBag();
        return $mockObRequest;
    }

    private function mockInputBag(): InputBag
    {
        $mockInputBag = $this->createConfiguredMock(InputBag::class, ['get' => 'test']);
        return $mockInputBag;
    }
    
}
