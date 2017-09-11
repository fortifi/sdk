<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\RefreshTokenGrant;
use PHPUnit\Framework\TestCase;

class RefreshTokenGrantTest extends TestCase
{
  public function testHandleResponse()
  {
    $grant = new RefreshTokenGrant();
    $response = $grant->handleResponse(['access_token' => 'a']);
    $this->assertInstanceOf('\Fortifi\Sdk\OAuth\FortifiAccessToken', $response);
  }
}
