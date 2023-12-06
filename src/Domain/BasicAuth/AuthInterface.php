<?php

namespace App\Domain\BasicAuth;

interface AuthInterface
{
    public function checkCredentials(): bool;
}
