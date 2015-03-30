<?php
namespace Fortifi\Tests\Sdk\OAuth;

use Fortifi\Sdk\OAuth\Client;
use Fortifi\Sdk\OAuth\FortifiProvider;
use League\OAuth2\Client\Token\AccessToken;

class FortifiProviderTest extends \PHPUnit_Framework_TestCase
{
  public function testUrls()
  {
    $fortifiUrl = 'http://org-dc-1448-6f535.fortifi.co';
    $provider = new FortifiProvider();
    $provider->setFortifiUrl($fortifiUrl);
    $provider->setOrgFid('org-dc-1448-6f535');

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
      $fortifiUrl . '/auth/details?access_token=abc',
      $provider->urlUserDetails(new AccessToken(['access_token' => 'abc']))
    );
  }

  public function testUserDetails()
  {
    $token = new AccessToken(['access_token' => 'abc']);

    $response = '{"status":{"code":200,"message":""},'
      . '"type":"\\\\Fortifi\\\\FortifiApi\\\\Auth\\\\Responses\\\\AuthUserDetailsResponse",'
      . '"result":{'
      . '"userFid":"FID:AUTH:USER:1424364068:2972543",'
      . '"avatarUrl":null,'
      . '"authedFid":"FID:EMPL:1424364068:bee20f637947",'
      . '"language":"en",'
      . '"timezone":"UTC",'
      . '"username":"brooke",'
      . '"isApproved":false,'
      . '"isDisabled":false,'
      . '"userType":"3",'
      . '"displayName":"Brooke Bryan",'
      . '"firstName":"Brooke",'
      . '"lastName":"Bryan",'
      . '"description":"",'
      . '"permissions":"1",'
      . '"roles":'
      . '["1",'
      . '"FID:EMPL:ROLE:1424355162:753bc09",'
      . '"affiliate.manager",'
      . '"5",'
      . '"FID:EMPL:ROLE:1426510567:793210d"]'
      . '}}';
    $details = json_decode($response);
    $details = $details->result;

    $provider = new FortifiProvider();
    $provider->setUserDetailsCache($response);

    $user = $provider->getUserDetails($token);
    $this->assertEquals($details->userFid, $user->uid);

    $this->assertEquals($details->username, $provider->getUserEmail($token));
    $this->assertEquals(
      $details->displayName,
      $provider->getUserScreenName($token)
    );
    $this->assertEquals($details->userFid, $provider->getUserUid($token));
  }

  public function testClient()
  {
    $provider = new FortifiProvider();
    $provider->setClient(new Client('client', 'secret'));
    $this->assertEquals('client', $provider->getClient()->getId());
    $this->assertEquals('secret', $provider->getClient()->getSecret());
  }
}
