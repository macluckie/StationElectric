<?php

namespace App\Action;

use App\Domain\Station\ServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\HttpException;


class StationService implements ServiceInterface
{
    /**
     *
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * 
     * @var StationRepo
     */
    private $stationRepo;


    public function __construct(EntityManagerInterface $em, StationRepo $stationRepo)
    {
        $this->em = $em;
        $this->stationRepo = $stationRepo;
    }

    public function getStationsAction(RequestStack $request): array
    {
        $position = $this->getLatLon($request);
        if($position[0] == null || $position[1]  == null){
            throw new HttpException(401, 'error: position not found');
        }
        $station = $this->stationRepo->getStationsAction($position, 'stations','*','NomStation', 'Coordo',
        $position[0].','.$position[1]);
        return  $station;
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
