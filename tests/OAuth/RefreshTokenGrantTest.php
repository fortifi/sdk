<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\RefreshTokenGrant;

class RefreshTokenGrantTest extends \PHPUnit_Framework_TestCase
{
  public function testHandleResponse()
  {
    $grant = new RefreshTokenGrant();
    $response = $grant->handleResponse(['access_token' => 'a']);
    $this->assertInstanceOf('\Fortifi\Sdk\OAuth\FortifiAccessToken', $response);
  }
}
