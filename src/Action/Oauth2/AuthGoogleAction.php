<?php

namespace App\Action\Oauth2;

use App\Domain\Oauth2\GoogleOauth2Interface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Oauth2\GoogleURL;
use App\Domain\Oauth2\OauthData;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Domain\Entity\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class AuthGoogleAction implements GoogleOauth2Interface
{
    /**
     * Undocumented variable
     *
     * @var Request
     */
    private $request;

    /**
     * Undocumented variable
     *
     * @var HttpClientInterface
     */
    private $client;

    /**
     * Undocumented variable
     *
     * @var GoogleURL
     */
    private $urls;

    public function __construct(Request $request, HttpClientInterface $client)
    {
        $this->request = $request;
        $this->client = $client;
        $this->urls = $this->discoveryEndPointGoogle();
    }

    private function serializer(): Serializer
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer;
    }

    public function discoveryEndPointGoogle(): GoogleURL
    {
        $response = $this->client->request('GET', $_ENV['GOOGLE_DISCOVERY_URL']);
        $urls = $this->serializer()->deserialize($response->getContent(), GoogleURL::class, 'json');
        return $urls;
    }

    public function getCode(): OauthData
    {
        $dataOauth = new OAuthData();
        if ($this->request->query->has('code')) {
            $dataOauth->code = $this->request->query->get('code');
        }
        return $dataOauth;
    }


    public function urlAUTH(): string
    {
        $urlGoogle = $this->urls->authorization_endpoint . '?client_id=' . $_ENV['GOOGLE_SECRET'] . '&response_type=code&redirect_uri=' . $_ENV['REDIRECT_URL'] . '&scope=email&access_type=offline';
        return $urlGoogle;
    }

    public function getAccessToken(OauthData $codeData): OauthData
    {
        try {
            $response = $this->client->request('POST', $this->urls->token_endpoint, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => [
                    'client_id' => $_ENV['GOOGLE_SECRET'],
                    'client_secret' => $_ENV['CODE_SECRET'],
                    'code' =>  $codeData->code,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $_ENV['REDIRECT_URL']
                ]
            ]);

            $secureData = $this->serializer()->deserialize($response->getContent(), OauthData::class, 'json');
            return $secureData;
        } catch (\Throwable $th) {
            throw new UnauthorizedHttpException($th->getMessage());
        }
    }

    public function getUserInformation(OAuthData $accessToken): User
    {
        try {
            $response = $this->client->request('GET', $this->urls->userinfo_endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken->access_token,
                ],
            ]);
            $user = $this->serializer()->deserialize($response->getContent(), User::class, 'json');
            return $user;
        } catch (\Throwable $th) {
            throw new UnauthorizedHttpException($th->getMessage());
        }
    }
}
