<?php

namespace App\Tests\Domain;

use PHPUnit\Framework\TestCase;
use App\Tests\UtilsTest;
use App\Domain\BasicAuth\CheckBasicAuth;
use App\Action\BasicAuth\BasicAuth;



class CheckBasicAuthTest extends TestCase
{
    use UtilsTest;

    public function  testCheckCredentialsFalse()
    {
        $basicAction = $this->getMockBasicAuthFalse();
        $check = new CheckBasicAuth($basicAction);
        $this->assertFalse($check->checkAuthorization());
    }

    public function  testCheckCredentialstrue()
    {
        $basicAction = $this->getMockBasicAuthTrue();
        $check = new CheckBasicAuth($basicAction);
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
