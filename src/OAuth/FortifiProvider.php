<?php
namespace Fortifi\Sdk\OAuth;

use Fortifi\FortifiApi\Auth\Responses\AuthUserDetailsResponse;
use Fortifi\FortifiApi\Foundation\Exceptions\FortifiApiException;
use Guzzle\Http\Exception\BadResponseException;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\Stream;
use League\OAuth2\Client\Exception\IDPException;
use League\OAuth2\Client\Grant\GrantInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Packaged\Api\Exceptions\InvalidApiResponseException;
use Packaged\Api\Format\JsonFormat;
use Packaged\Api\Response\ApiCallData;
use Packaged\Api\Response\ResponseBuilder;

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
   * @param AccessToken $token
   *
   * @return string
   */
  public function urlLogout(AccessToken $token)
  {
    return build_path_unix($this->_url, 'auth', 'logout')
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
    $user = new OAuthUser();
    $result = idp($response, 'result', $response);
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
        'name'        => $result->displayName,
        'imageUrl'    => $result->avatarUrl,
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
    return $this->_getProperty($response, ['userFid', 'authedFid', 'id']);
  }

  public function userEmail($response, AccessToken $token)
  {
    return $this->_getProperty($response, ['email', 'username']);
  }

  public function userScreenName($response, AccessToken $token)
  {
    return $this->_getProperty($response, ['displayName', 'name', 'firstName']);
  }

  protected function _getProperty($object, $propertyList)
  {
    $properties = (array)$propertyList;
    $result = pnonempty($object, $properties);
    if($result === null && isset($object->result))
    {
      $result = pnonempty($object->result, $properties);
    }
    return $result;
  }

  public function logout(AccessToken $token)
  {
    $this->fetchProviderData(
      $this->urlLogout($token),
      $this->getHeaders($token)
    );
    return true;
  }

  protected function fetchUserDetails(AccessToken $token)
  {
    if($this->_userDetails === null)
    {
      $this->setUserDetailsCache(parent::fetchUserDetails($token));
    }
    return $this->_userDetails;
  }

  protected function fetchProviderData($url, array $headers = [])
  {
    $time = microtime(true);
    try
    {
      $client = $this->getHttpClient();
      $client->setBaseUrl($url);

      if($headers)
      {
        $client->setDefaultOption('headers', $headers);
      }

      $request = $client->get()->send();
      $response = $request->getBody();
    }
    catch(BadResponseException $e)
    {
      // @codeCoverageIgnoreStart
      $decode = new JsonFormat();
      try
      {
        $totalTime = microtime(true) - $time;

        $response = $decode->decode(
          new Response(
            $e->getResponse()->getStatusCode(),
            $e->getResponse()->getHeaders()->getAll(),
            new Stream($e->getResponse()->getBody()->getStream())
          ),
          $totalTime
        );

        throw new \Exception(
          $response->getApiCallData()->getStatusMessage(),
          $response->getApiCallData()->getStatusCode(),
          $e
        );
      }
      catch(InvalidApiResponseException $ex)
      {
        $raw_response = explode("\n", $e->getResponse());
        throw new IDPException(end($raw_response));
      }
      // @codeCoverageIgnoreEnd
    }

    return $response;
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

  public function getHeaders($token = null)
  {
    $headers = parent::getHeaders($token);
    return array_merge($headers, ['X-Fortifi-Org' => $this->_orgFid]);
  }
}
