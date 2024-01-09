<?php

namespace App\Domain\Oauth2;
use App\Domain\Entity\User;


interface GoogleOauth2Interface
{
    function getCode(): OauthData;
    function discoveryEndPointGoogle(): GoogleURL;
    function getAccessToken(OauthData $code): OauthData;
    function getUserInformation(OAuthData $accessToken): User;
}
