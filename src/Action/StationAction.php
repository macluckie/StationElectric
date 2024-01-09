<?php

namespace App\Action;

use App\Domain\Station\ActionInterface;
use App\Domain\Station\StationRepoInterface;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class StationAction implements ActionInterface
{
    /**
     * 
     * @var StationRepoInterface
     */
    private $stationRepo;


    public function __construct(StationRepoInterface $stationRepo)
    {
        $this->stationRepo = $stationRepo;
    }

    /**
     *
     * @param RequestStack $request
     * @return array<\App\Domain\Entity\Station>
     */
    public function stationsAtPosition(RequestStack $request): array
    {
        $cache = new FilesystemAdapter();
        $stations = $cache->get('stations', function (ItemInterface $item) use ($request): array {
            $item->expiresAfter(300);
            $position = $this->getLatLon($request);
            if($position[0] == null || $position[1]  == null){
                throw new HttpException(401, 'error: position not found');
            }
            $station = $this->stationRepo->getAllStations();       
            return $station;
        });
   
        return  $stations;
    }

    /**
     *
     * @param RequestStack $request
     * @return array<string>
     */
    public function getLatLon(RequestStack $request): array
    {
        $lat = $request->getCurrentRequest()->query->get('latitude');
        $lon = $request->getCurrentRequest()->query->get('longitude');
        if ($lat == null || $lon == null) {
            return [];
        }
        return [$lat, $lon];
    }
}
