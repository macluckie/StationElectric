<?php

namespace App\Action\BasicAuth;

use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\BasicAuth\BasicAuthInterface;


class BasicAuth implements BasicAuthInterface
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
