<?php

namespace App\Domain\Oauth2;

use App\Domain\Entity\User;

class OauthGoogle
{

    /**
     * Undocumented variable
     *
     * @var GoogleOauth2Interface
     */
    private GoogleOauth2Interface $auth;

    /**
     * @param RepositoryInterface $auth
     */
    private RepositoryInterface $repo;

    public function __construct(GoogleOauth2Interface $auth, RepositoryInterface $repo)
    {
        $this->auth = $auth;
        $this->repo = $repo;
    }

    public function getCode(): ?OauthData {
        $codeData =  $this->auth->getCode();
        return isset($codeData->code) ? $codeData : null;
    }

    public function getAccessToken(OauthData $codeData): ?OauthData {
        $accessTokenData =  $this->auth->getAccessToken($codeData);
        return $accessTokenData && isset($accessTokenData->access_token) ? $accessTokenData : null;
    }

    public function getUserInformation(OauthData $accessTokenData): ?User {
        return $accessTokenData->access_token != null ? $this->auth->getUserInformation($accessTokenData): null;
    }

    public function getUserOauthGoogle(): ?User
    {
        $codeData =  $this->getCode();
        if ($codeData == null) {            
            return null;
        }
        $accessTokenData =  $this->getAccessToken($codeData);
        $user = $this->auth->getUserInformation($accessTokenData);
        $userREC =  $this->addUser($user);
        return $userREC;
    }

    private function addUser(User $user): User
    {
        return  $this->repo->addUser($user);
    }
}
