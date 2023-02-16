<?php

namespace App\Domain\Oauth2;

class OauthData
{
    public string $code;
    public int $expires_in;
    public string $scope;
    public string $token_type;
    public string $access_token;
    public string $id_token;
    public string $refresh_token;
}
