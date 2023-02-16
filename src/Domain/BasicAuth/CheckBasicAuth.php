<?php

namespace App\Domain\BasicAuth;

class CheckBasicAuth
{
    /**
     * @var BasicAuthInterface
     */
    private BasicAuthInterface $basic;

    public function __construct(BasicAuthInterface $basic)
    {
        $this->basic = $basic;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function checkAuthorization(): bool
    {
        return $this->basic->checkCredentials();
    }
}
