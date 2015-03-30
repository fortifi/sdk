<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\FortifiAccessToken;

class FortifiAccessTokenTest extends \PHPUnit_Framework_TestCase
{
  public function testSessionSecret()
  {
    $token = new FortifiAccessToken(
      ['access_token' => 'abc', 'session_secret' => 'def']
    );
    $this->assertEquals('def', $token->getSessionSecret());
  }
}
