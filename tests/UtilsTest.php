<?php

namespace App\Tests;

use App\Domain\Entity\Station;

trait UtilsTest
{
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

    private function dataproviderEmptyArray(): array
    {
        return [];
    }
}
