<?php
namespace Fortifi\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class FortifiProvider extends AbstractProvider
{
  protected $_url;
  protected $_userDetails;
  /**
   * @var Client
   */
  protected $_client;

  /**
   * @param $url
   *
   * @return $this
   */
  public function setFortifiUrl($url)
  {
    $this->_url = $url;
    return $this;
  }

  /**
   * Retrieve the Fortifi URL
   *
   * @return string
   */
  public function getFortifiUrl()
  {
    return $this->_url;
  }

  /**
   * @return string
   */
  public function urlAuthorize()
  {
    return build_path_unix($this->_url, 'oauth', 'authorize');
  }

  /**
   * @return string
   */
  public function urlAccessToken()
  {
    return build_path_unix($this->_url, 'oauth', 'access-token');
  }

  /**
   * @param AccessToken $token
   *
   * @return string
   */
  public function urlUserDetails(AccessToken $token)
  {
    return build_path_unix($this->_url, 'auth', 'details')
    . '?access_token=' . $token->accessToken;
  }

  /**
   * @param             $response
   * @param AccessToken $token
   *
   * @return OAuthUser
   */
  public function userDetails($response, AccessToken $token)
  {
    $user   = new OAuthUser();
    $result = $response->result;
    /**
     * @var $result AuthUserDetailsResponse
     */
    if(!($result instanceof AuthUserDetailsResponse))
    {
      $result = AuthUserDetailsResponse::make($result);
    }
    $user->setAuthUserDetails($result);
    $user->exchangeArray(
      [
        'uid'         => $result->userFid,
        'nickname'    => nonempty(
          $result->displayName,
          $result->firstName,
          $result->lastName,
          $result->username,
          $result->userFid
        ),
        'locale'      => $result->language,
        'location'    => $result->timezone,
        'firstName'   => $result->firstName,
        'lastName'    => $result->lastName,
        'description' => $result->description,
        'email'       => $result->username
      ]
    );
    return $user;
  }

  public function userUid($response, AccessToken $token)
  {
    return isset($response->id) && $response->id ? $response->id : null;
  }

  public function userEmail($response, AccessToken $token)
  {
    return isset($response->email) && $response->email ? $response->email : null;
  }

  public function userScreenName($response, AccessToken $token)
  {
    return isset($response->name) && $response->name ? $response->name : null;
  }

  protected function fetchUserDetails(AccessToken $token)
  {
    if($this->_userDetails === null)
    {
      $this->setUserDetailsCache(parent::fetchUserDetails($token));
    }
    return $this->_userDetails;
  }

  public function setUserDetailsCache($response)
  {
    $this->_userDetails = $response;
    return $this;
  }

  public function setClient(Client $client)
  {
    $this->_client = $client;
  }

  /**
   * @return Client
   */
  public function getClient()
  {
    return $this->_client;
  }
}
