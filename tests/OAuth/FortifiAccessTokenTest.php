<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\FortifiAccessToken;
use PHPUnit\Framework\TestCase;

class FortifiAccessTokenTest extends TestCase
{
  public function testSessionSecret()
  {
    $token = new FortifiAccessToken(
      ['access_token' => 'abc', 'session_secret' => 'def']
    );
    $this->assertEquals('def', $token->getSessionSecret());
  }
}
