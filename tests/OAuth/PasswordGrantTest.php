<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\PasswordGrant;

class PasswordGrantTest extends \PHPUnit_Framework_TestCase
{
  public function testHandleResponse()
  {
    $grant = new PasswordGrant();
    $response = $grant->handleResponse(['access_token' => 'a']);
    $this->assertInstanceOf('\Fortifi\Sdk\OAuth\FortifiAccessToken', $response);
  }
}
