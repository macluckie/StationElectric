<?php

namespace App\Action\BasicAuth;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\BasicAuth\AuthInterface;


class BasicAuth implements AuthInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function checkCredentials(): bool
    {
       return $headerParams = $this->requestStack->getCurrentRequest()->headers->get('x-station') == 'toto' ? true : false;   
    }
}
