<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\Client;
use Fortifi\Sdk\OAuth\FortifiProvider;
use League\OAuth2\Client\Token\AccessToken;

class FortifiProviderTest extends \PHPUnit_Framework_TestCase
{
  public function testUrls()
  {
    $fortifiUrl = 'https://org-dc-1448-6f535.fortifi.co';
    $provider   = new FortifiProvider();
    $provider->setFortifiUrl($fortifiUrl);

    $this->assertEquals($fortifiUrl, $provider->getFortifiUrl());

    $this->assertEquals(
      $fortifiUrl . '/oauth/access-token',
      $provider->urlAccessToken()
    );

    $this->assertEquals(
      $fortifiUrl . '/oauth/authorize',
      $provider->urlAuthorize()
    );

    $this->assertEquals(
      $fortifiUrl . '/oauth/details?access_token=abc',
      $provider->urlUserDetails(new AccessToken(['access_token' => 'abc']))
    );
  }

  public function testUserDetails()
  {
    $token          = new AccessToken(['access_token' => 'abc']);
    $details        = new \stdClass();
    $details->id    = 123;
    $details->uid   = 'FID:USER:2374';
    $details->name  = 'John Smith';
    $details->email = 'john@smith.com';

    $provider = new FortifiProvider();
    $provider->setUserDetailsCache(json_encode($details));

    $this->assertEquals('john@smith.com', $provider->getUserEmail($token));
    $this->assertEquals('John Smith', $provider->getUserScreenName($token));
    $this->assertEquals(123, $provider->getUserUid($token));

    $user = $provider->getUserDetails($token);
    $this->assertEquals('FID:USER:2374', $user->uid);
  }

  public function testClient()
  {
    $provider = new FortifiProvider();
    $provider->setClient(new Client('client', 'secret'));
    $this->assertEquals('client', $provider->getClient()->getId());
    $this->assertEquals('secret', $provider->getClient()->getSecret());
  }
}
