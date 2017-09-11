<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use Fortifi\Sdk\OAuth\OAuthUser;
use PHPUnit\Framework\TestCase;

class OAuthUserTest extends TestCase
{
  public function testAuthUserDetails()
  {
    $user = new OAuthUser([], "");
    $details = new AuthUserDetailsResponse();
    $details->userFid = 'testing';
    $user->setAuthUserDetails($details);
    $this->assertSame($details, $user->getAuthUserDetails());
  }
}
