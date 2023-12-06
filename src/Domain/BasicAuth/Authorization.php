<?php

namespace App\Domain\BasicAuth;

class Authorization
{
    /**
     * @var BasicAuthInterface
     */
    private AuthInterface $credential;

    public function __construct(AuthInterface $credential)
    {
        $this->credential = $credential;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function checkAuthorization(): bool
    {
        return $this->credential->checkCredentials();
    }
}
