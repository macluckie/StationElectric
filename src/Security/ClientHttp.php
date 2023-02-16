<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ClienHttp implements ClientHttpInterface
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function discoveryEndPointGoogle()
    {
        $response = $this->client->request('GET', $_ENV['GOOGLE_DISCOVERY_URL']);
        dd(json_decode($response->getContent()));
    }
    public function urlAUTH(): string
    {
        $urlGoogle = 'https://accounts.google.com/o/oauth2/v2/auth?client_id='. $_ENV['GOOGLE_SECRET'] . '&response_type=code&redirect_uri=' . $_ENV['REDIRECT_URL'] . '&scope=email&access_type=offline';
        return $urlGoogle;
    }

    public function getTokenAccess(Request $request)
    {
        if ($request->query->has('code')) {
            $response =  $this->requestToken($request->query->get('code'));
            $this->discoveryEndPointGoogle();
            dd($response->getContent());
        }
    }

    private function requestToken(string $code): ResponseInterface
    {
        $response = $this->client->request('POST', 'https://oauth2.googleapis.com/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => [
                'client_id' => $_ENV['GOOGLE_SECRET'],
                'client_secret' => $_ENV['CODE_SECRET'],
                'code' =>  $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $_ENV['REDIRECT_URL']
            ]
        ]);

        return $response;
    }
}
