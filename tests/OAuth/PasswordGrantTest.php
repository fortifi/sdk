<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\PasswordGrant;
use PHPUnit\Framework\TestCase;

class PasswordGrantTest extends TestCase
{
  public function testHandleResponse()
  {
    $grant = new PasswordGrant();
    $response = $grant->handleResponse(['access_token' => 'a']);
    $this->assertInstanceOf('\Fortifi\Sdk\OAuth\FortifiAccessToken', $response);
  }
}
