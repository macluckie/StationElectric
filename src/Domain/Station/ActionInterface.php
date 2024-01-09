<?php

namespace App\Domain\Station;

use App\Domain\Entity\Station;
use Symfony\Component\HttpFoundation\RequestStack;

interface ActionInterface
{
    /**
     * @return array<Station>
     */
    public function stationsAtPosition(RequestStack $request): array;
}
