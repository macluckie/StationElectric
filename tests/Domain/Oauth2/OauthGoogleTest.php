<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;
use App\Tests\UtilsTest;
use App\Domain\Oauth2\OauthGoogle;
use App\Domain\Oauth2\GoogleOauth2Interface;
use App\Domain\Oauth2\RepositoryInterface;
use App\Domain\Oauth2\OauthData;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Domain\Entity\User;

class OauthGoogleTest extends TestCase
{
    public function  testGetCode()
    {
        $mockoAuthInter = $this->getMocGoogleOauth2Interface();
        $mockoRepoInter = $this->getMocRepositoryInterface();
        $oauth = new OauthGoogle($mockoAuthInter, $mockoRepoInter);
        $this->assertEquals('123', $oauth->getCode()->code);
    }

    public function  testGetCodeNULL()
    {
        $mockoAuthInter = $this->getMocGoogleOauth2InterfaceWithDataNull();
        $mockoRepoInter = $this->getMocRepositoryInterface();
        $oauth = new OauthGoogle($mockoAuthInter, $mockoRepoInter);
        $this->assertNull($oauth->getCode());
    }


    public function  testGetAccessTokenWhenAllIsOK()
    {
        $data =  $this->dataproviderOauth();
        $mockoAuthInter = $this->getMocGoogleOauth2InterfaceAccessToken($data);
        $mockoRepoInter = $this->getMocRepositoryInterface();
        $oauth = new OauthGoogle($mockoAuthInter, $mockoRepoInter);
        $data = $this->dataproviderOauth();
        $this->assertEquals($data->access_token, $oauth->getAccessToken($data)->access_token);
    }


    public function  testGetAccessTokenWhenAllIsNULL()
    {
        $data =  $this->dataproviderOauthNULL();
        $mockoAuthInter = $this->getMocGoogleOauth2InterfaceAccessToken($data);
        $mockoRepoInter = $this->getMocRepositoryInterface();
        $oauth = new OauthGoogle($mockoAuthInter, $mockoRepoInter);
        $data = $this->dataproviderOauth();
        $this->assertNull($oauth->getAccessToken($data));
    }


    public function getMocGoogleOauth2Interface()
    {
        $data =  $this->dataproviderOauth();
        $mock = $this->createConfiguredMock(GoogleOauth2Interface::class, ['getCode' => $data]);
        return $mock;
    }

    public function getMocGoogleOauth2InterfaceAccessToken(OauthData $data)
    {
        $mock = $this->createConfiguredMock(GoogleOauth2Interface::class, ['getAccessToken' => $data]);
        return $mock;
    }

    public function getMocGoogleOauth2InterfaceWithDataNull()
    {
        $data =  $this->dataproviderOauthNULL();
        $mock = $this->createConfiguredMock(GoogleOauth2Interface::class, ['getCode' => $data]);
        return $mock;
    }

    public function getMocRepositoryInterface()
    {
        $user = $this->dataProviderUser();
        $mock = $this->createConfiguredMock(RepositoryInterface::class, ['addUser' => $user]);
        return $mock;
    }


    public function dataproviderOauth(): OauthData
    {
        $jsonArray =
            [
                'code' => '123',
                'access_token' => '35d4eb9c-cd5c-4963-a172-ffe7c2428d88d862e1f5-de99-444a-9101-0cba20f3c5e9'
            ];
        $jsonData = json_encode($jsonArray);
        $oAuthData = $this->serializer()->deserialize($jsonData, OauthData::class, 'json');
        return $oAuthData;
    }

    public function dataproviderOauthNULL(): OauthData
    {
        $jsonArray = [];
        $jsonData = json_encode($jsonArray);
        $oAuthData = $this->serializer()->deserialize($jsonData, OauthData::class, 'json');
        return $oAuthData;
    }

    public function dataProviderUser()
    {
        $jsonArray = 
        [
            'id' => "1",
            'email' => "test@example.com",
            'password' => "test"
        ];
        $jsonData = json_encode($jsonArray);
        $user = $this->serializer()->deserialize($jsonData, User::class, 'json');
        return $user;
    }


    private function serializer(): Serializer
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer;
    }
}
