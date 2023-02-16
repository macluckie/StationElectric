<?php

namespace App\Domain\BasicAuth;

interface BasicAuthInterface
{
    public function checkCredentials(): bool;
}
