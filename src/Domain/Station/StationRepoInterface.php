<?php

namespace App\Domain\Station;

use App\Domain\Entity\Station;

interface StationRepoInterface
{
    /**
     * @return array<Station>
     */
    public function getAllStations(): array;
}
