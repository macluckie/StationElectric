<?php

namespace App\Domain\Station;

use App\Entity\Station;
use Symfony\Component\HttpFoundation\RequestStack;

class StationService
{
    /**
     * @var ServiceInterface
     */
    private ServiceInterface $stationAction;

    /**
     * @var RequestStack
     */
    private RequestStack $request;

    public function __construct(ServiceInterface $stationAction, RequestStack $request)
    {
        $this->stationAction = $stationAction;
        $this->request       = $request;
    }

    /**
     *
     * @return array<Station>
     */
    public function getStations(): array
    {
        $stations = null;
        try {
            $stations = $this->stationAction->getStationsAction($this->request);
        } catch (\Throwable $th) {
            $stations = [$th->getMessage()];
        }
        return $stations;
    }
}
