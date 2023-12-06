<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;
use App\Tests\UtilsTest;
use App\Domain\BasicAuth\Authorization;
use App\Action\BasicAuth\BasicAuth;



class AuthorizationTest extends TestCase
{
    use UtilsTest;

    public function  testCheckCredentialsFalse()
    {
        $basicAction = $this->getMockBasicAuthFalse();
        $check = new Authorization($basicAction);
        $this->assertFalse($check->checkAuthorization());
    }

    public function  testCheckCredentialstrue()
    {
        $basicAction = $this->getMockBasicAuthTrue();
        $check = new Authorization($basicAction);
        $this->assertTrue($check->checkAuthorization());
    }


    public function getMockBasicAuthFalse()
    {
        $mock = $this->createConfiguredMock(BasicAuth::class, ['checkCredentials' => false]);
        return $mock;
    }

    public function getMockBasicAuthTrue()
    {
        $mock = $this->createConfiguredMock(BasicAuth::class, ['checkCredentials' => true]);
        return $mock;
    }
}
