<?php
namespace Fortifi\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use League\OAuth2\Client\Grant\AbstractGrant;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Packaged\Helpers\Arrays;
use Packaged\Helpers\Path;
use Packaged\Helpers\ValueAs;
use Psr\Http\Message\ResponseInterface;

class FortifiProvider extends AbstractProvider
{
  protected $_url;
  protected $_userDetails;
  protected $_orgFid;
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
   * Set the current organisation FID
   *
   * @param $fid
   *
   * @return $this
   */
  public function setOrgFid($fid)
  {
    $this->_orgFid = $fid;
    return $this;
  }

  /**
   * Retrieve the current organisation ID
   *
   * @return string|null
   */
  public function getOrgFid()
  {
    return $this->_orgFid;
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
   * @param AccessToken $token
   *
   * @return string
   */
  public function urlLogout(AccessToken $token)
  {
    return Path::buildUnix($this->_url, 'auth', 'logout')
      . '?access_token=' . $token->getToken();
  }

  /**
   * Generates a resource owner object from a successful resource owner
   * details request.
   *
   * @param  array       $response
   * @param  AccessToken $token
   *
   * @return ResourceOwnerInterface
   */
  protected function createResourceOwner(array $response, AccessToken $token)
  {
    $result = isset($response['result']) ? $response['result'] : [];

    /**
     * @var $result AuthUserDetailsResponse
     */
    if(!($result instanceof AuthUserDetailsResponse))
    {
      $result = AuthUserDetailsResponse::make($result);
    }
    $user = new OAuthUser(
      [
        'uid'         => $result->userFid,
        'nickname'    => ValueAs::nonempty(
          $result->displayName,
          $result->firstName,
          $result->lastName,
          $result->username,
          $result->userFid
        ),
        'locale'      => $result->language,
        'location'    => $result->timezone,
        'name'        => $result->displayName,
        'imageUrl'    => $result->avatarUrl,
        'firstName'   => $result->firstName,
        'lastName'    => $result->lastName,
        'description' => $result->description,
        'email'       => $result->username,
      ], $result->userFid
    );
    $user->setAuthUserDetails($result);
    return $user;
  }

  public function userUid(ResourceOwnerInterface $owner)
  {
    return Arrays::inonempty(
      $owner->toArray(),
      ['userFid', 'authedFid', 'uid']
    );
  }

  public function userEmail(ResourceOwnerInterface $owner)
  {
    return Arrays::inonempty($owner->toArray(), ['email', 'username']);
  }

  public function userScreenName(ResourceOwnerInterface $owner)
  {
    return Arrays::inonempty(
      $owner->toArray(),
      ['displayName', 'name', 'firstName']
    );
  }

  public function logout(AccessToken $token)
  {
    $this->getParsedResponse(
      $this->getAuthenticatedRequest(
        "POST",
        $this->urlLogout($token),
        $token,
        ['headers' => $this->getHeaders($token)]
      )
    );
    return true;
  }

  protected function fetchResourceOwnerDetails(AccessToken $token)
  {
    if($this->_userDetails === null)
    {
      $this->setUserDetailsCache(parent::fetchResourceOwnerDetails($token));
    }
    return $this->_userDetails;
  }

  public function setUserDetailsCache($response)
  {
    if(is_string($response))
    {
      $this->_userDetails = $this->parseJson($response);
    }
    else
    {
      $this->_userDetails = $response;
    }
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

  public function getHeaders($token = null)
  {
    $headers = parent::getHeaders($token);
    return array_merge($headers, ['X-Fortifi-Org' => $this->_orgFid]);
  }

  /**
   * Returns the base URL for authorizing a client.
   *
   * Eg. https://oauth.service.com/authorize
   *
   * @return string
   */
  public function getBaseAuthorizationUrl()
  {
    return Path::buildUnix($this->_url, 'oauth', 'authorize');
  }

  /**
   * Returns the base URL for requesting an access token.
   *
   * Eg. https://oauth.service.com/token
   *
   * @param array $params
   *
   * @return string
   */
  public function getBaseAccessTokenUrl(array $params)
  {
    return Path::buildUnix($this->_url, 'oauth', 'access-token');
  }

  /**
   * Returns the URL for requesting the resource owner's details.
   *
   * @param AccessToken $token
   *
   * @return string
   */
  public function getResourceOwnerDetailsUrl(AccessToken $token)
  {
    return Path::buildUnix($this->_url, 'auth', 'details')
      . '?access_token=' . $token->getToken();
  }

  /**
   * Returns the default scopes used by this provider.
   *
   * This should only be the scopes that are required to request the details
   * of the resource owner, rather than all the available scopes.
   *
   * @return array
   */
  protected function getDefaultScopes()
  {
    return [];
  }

  /**
   * Checks a provider response for errors.
   *
   * @throws IdentityProviderException
   *
   * @param  ResponseInterface $response
   * @param  array|string      $data Parsed response data
   *
   * @return void
   */
  protected function checkResponse(ResponseInterface $response, $data)
  {
    if($response->getStatusCode() != 200)
    {
      $msg = Arrays::value($data, 'message', 'An unknown error occurred');
      throw new IdentityProviderException($msg, $response->getStatusCode(), (array)$data);
    }
  }

  /**
   * Creates an access token from a response.
   *
   * The grant that was used to fetch the response can be used to provide
   * additional context.
   *
   * @param  array         $response
   * @param  AbstractGrant $grant
   *
   * @return AccessToken
   */
  protected function createAccessToken(array $response, AbstractGrant $grant)
  {
    if($grant instanceof FortifiGrant)
    {
      return $grant->handleResponse($response);
    }
    return new AccessToken($response);
  }

}
