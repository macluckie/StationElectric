<?php

namespace App\Domain\Station;

use App\Entity\Station;
use Symfony\Component\HttpFoundation\RequestStack;

interface ServiceInterface
{
    /**
     * @return array<Station>
     */
    public function getStationsAction(RequestStack $request): array;
}
