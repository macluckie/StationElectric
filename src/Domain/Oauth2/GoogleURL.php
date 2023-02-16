<?php

namespace App\Domain\Oauth2;

class GoogleURL
{
    public string $issuer;
    public string $authorization_endpoint;
    public string $device_authorization_endpoint;
    public string $token_endpoint;
    public string $userinfo_endpoint;
    public string $revocation_endpoint;
    public string $jwks_uri;
    public array $response_types_supported;
}
